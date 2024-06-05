<?php

namespace App\Filament\Pages;

use App\Models\Ad;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Collection;

class ViewAds extends Page
{
    protected static ?int $navigationSort = 0;
    protected static ?string $model = Ad::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.view-ads';

    public $showModal = true;
    public Collection $ads;
    public $currentAdIndex = 0;
    public $firstAdImage;
    public $firstAdLink;
    public $firstAdDesc;
    public $firstAdTitle;

    public function mount()
    {
        Session::put('showModal', true);
        $this->showModal = Session::get('showModal', true);

        // Fetch all ads
        $this->ads = Ad::all();

        // Ensure there's at least one ad
        if ($this->ads->isNotEmpty()) {
            $this->setAdProperties(0);
        }
    }

    public function showModalFunction()
    {
        // dd('fdsfsfs');
        $this->showModal = true;
        Session::put('showModal', true);
    }

    public function hideModal()
    {

        $this->showModal = false;
        Session::put('showModal', false);
    }

    public function previousAd()
    {
        $this->currentAdIndex = ($this->currentAdIndex - 1 + $this->ads->count()) % $this->ads->count();
        $this->setAdProperties($this->currentAdIndex);
    }

    public function nextAd()
    {
        $this->currentAdIndex = ($this->currentAdIndex + 1) % $this->ads->count();
        $this->setAdProperties($this->currentAdIndex);
    }

    private function setAdProperties($index)
    {
        $ad = $this->ads[$index];
        $this->firstAdImage = $ad->image_path;
        $this->firstAdLink = $ad->link;
        $this->firstAdDesc = $ad->description;
        $this->firstAdTitle = $ad->title;
    }
}
