<?php

namespace App\Http\Controllers;

use App\Events\Userlog;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\ArchivedAnnouncement;
use App\Models\Barangay;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
{
    // Ma move ang expired nga announcement didto sa archive ug ma abot nag 3 months
    $expiredAnnouncements = Announcement::where('barangay_id', Auth::user()->barangay_id)
        ->where('expiration_date', '<', now()->subMonths(3)) 
        ->get();

    foreach ($expiredAnnouncements as $announcement) {
        // Padung sa archive ni
        ArchivedAnnouncement::create([
            'user_id' => $announcement->user_id,
            'barangay_id' => $announcement->barangay_id,
            'title' => $announcement->title,
            'announcement_date' => $announcement->announcement_date,
            'expiration_date' => $announcement->expiration_date,
            'content' => $announcement->content,
            'imgUrl' => $announcement->imgUrl,
            'is_global' => $announcement->is_global,
        ]);

        // E delete tung naa sa original nga gi display
        $announcement->delete();
    }

    // Mau ni nga part ang mo kuha sa active pa nga announcement
    $announcements = Announcement::where('barangay_id', Auth::user()->barangay_id)
        ->where(function ($query) {
            $query->where('expiration_date', '>=', now()) // active pa
                  ->orWhereNull('expiration_date');   
        })
        ->orWhere('is_global', true) // Apil ang global announcements
        ->orderByRaw('is_global DESC')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    return view('barangay.announcement.index', compact('announcements'));
}


    public function archived()
    {
        $archivedAnnouncements = ArchivedAnnouncement::where('barangay_id', Auth::user()->barangay_id)
                                                    ->orderBy('created_at', 'desc')
                                                    ->paginate(10);

        return view('barangay.announcement.archived.index', compact('archivedAnnouncements'));
    }

    public function restore(Request $request, $id)
    {
        $archivedAnnouncement = ArchivedAnnouncement::findOrFail($id);

        $announcement = Announcement::create([
            'user_id' => $archivedAnnouncement->user_id,
            'barangay_id' => $archivedAnnouncement->barangay_id,
            'title' => $archivedAnnouncement->title,
            'announcement_date' => $archivedAnnouncement->announcement_date,
            'expiration_date' => $request->expiration_date ?? $archivedAnnouncement->expiration_date,
            'content' => $archivedAnnouncement->content,
            'imgUrl' => $archivedAnnouncement->imgUrl,
            'is_global' => $archivedAnnouncement->is_global,
        ]);

        $archivedAnnouncement->delete();

        return redirect()->route('barangay.announcement.archived')->with('success', 'Announcement restored successfully!');
    }



    public function userIndex()
    {
        $announcements = Announcement::where(function($query) {
            $query->where('barangay_id', Auth::user()->barangay_id)
                  ->where(function($query) {
                      
                      $query->where('expiration_date', '>=', now())
                            ->orWhereNull('expiration_date');
                  });
        })
        ->orWhere('is_global', true) 
        ->orderByRaw('is_global DESC')  
        ->orderBy('created_at', 'desc') 
        ->paginate(10);
        return view('user.announcement.index', compact('announcements'));
    }
    
    

    public function create()
    {
        return view('barangay.announcement.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'announcement_date' => 'required|date',
            'expiration_date' => 'required|date|after:today',
            'content' => 'required|max:10000',
            'imgUrl' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        
        if ($request->has('imgUrl')) {

            $file = $request->file('imgUrl');
            $extension = $file->getClientOriginalExtension();

            $filename = time() . '.' .$extension;

            $path = 'storage/announcement/';
            $file->move($path, $filename);

            $filename = 'announcement/' . $filename;


        }


        Announcement::create([
            'user_id' => Auth::user()->id,
            'barangay_id' => Auth::user()->barangay_id,
            'title' => $request->title,
            'announcement_date' => $request->announcement_date,
            'expiration_date' => $request->expiration_date,
            'content' => $request->content,
            'imgUrl' => $filename,
            'is_global' => false, 

        ]);

        $log_entry = 'Admin Added a new Announcement titled as ' . $request->title;
        event(new UserLog($log_entry));

        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully!');
    }


    public function show($announcementId)
    {
        $announcement = Announcement::findOrFail($announcementId);
        $barangay = $announcement->barangay; 
    
        return view('barangay.announcement.show', compact('announcement', 'barangay'));
    }

    public function updateAnnouncement(Request $request, Announcement $announcement)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'announcement_date' => 'required|date',
        'expiration_date' => 'required|date|after_or_equal:today',
        'content' => 'required|string',
        'imgUrl' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Directory path for storing announcement images
    $storagePath = public_path('storage/announcement');

    // Ensure the directory exists
    if (!file_exists($storagePath)) {
        mkdir($storagePath, 0755, true);
    }

    if ($request->hasFile('imgUrl')) {
        // Path to the old image
        $oldImagePath = $storagePath . '/' . $announcement->imgUrl;

        // Delete the old image if it exists
        if ($announcement->imgUrl && file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }

        // Use the same name as the old image, or generate one if no old name exists
        $newImageName = $announcement->imgUrl ?? uniqid() . '.' . $request->file('imgUrl')->getClientOriginalExtension();

        // Move the new file to the storage directory with the same name
        $request->file('imgUrl')->move($storagePath, $newImageName);
    } else {
        // If no new image is uploaded, retain the old image name
        $newImageName = $announcement->imgUrl;
    }

    // Update the announcement record
    $announcement->update([
        'title' => $request->title,
        'announcement_date' => $request->announcement_date,
        'expiration_date' => $request->expiration_date,
        'content' => $request->content,
        'imgUrl' => $newImageName,
    ]);

    return redirect()->route('announcements.index')->with('success', 'Announcement updated successfully!');
}



    public function previousView()
    {
        $announcements = Announcement::where('barangay_id', Auth::user()->barangay_id)
                                ->where('expiration_date', '<', now())
                                ->orderBy('expiration_date', 'desc')
                                ->paginate(10);
    
        return view('barangay.announcement.previous', compact('announcements'));
    }

    public function userPreviousView()
    {
        $announcements = Announcement::where('barangay_id', Auth::user()->barangay_id)
        ->where('expiration_date', '<', now())
        ->orderBy('expiration_date', 'desc')
        ->paginate(10);

        return view('user.announcement.previous', compact('announcements'));
    }
    
    public function showUser($announcementId)
    {
        $announcement = Announcement::findOrFail($announcementId);
        $barangay = $announcement->barangay; 
    
        return view('user.announcement.show', compact('announcement', 'barangay'));
    }

    
}

