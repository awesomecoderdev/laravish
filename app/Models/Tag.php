<?php

namespace App\Models;

use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Color\Rgb;
use BaconQrCode\Renderer\Color\Alpha;
use BaconQrCode\Renderer\RendererStyle\Fill;
use BaconQrCode\Writer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SVG\Nodes\Embedded\SVGImage;
use SVG\Nodes\Shapes\SVGRect;
use SVG\Nodes\Structures\SVGFont;
use SVG\SVG;

class Tag extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function user()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    public function sightings()
    {
        return $this->hasMany(Sighting::class);
    }

    public function getSightingURL() {
        return get_home_url() . "/". $this->code;
    }

    public function getActivationURL()
    {
        return  get_home_url() . "/activate/" . $this->code."?activation=".urlencode($this->activationcode);
    }


    protected function randomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 8; $i++) {
            $randstring .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randstring;
    }

    public function generateCodes() {
        if (($this->code == null)||($this->code == "")) {
            $this->code = "fas".$this->randomString();
        }
        if (($this->activationcode == null)||($this->activationcode == "")) {
            $this->activationcode = $this->randomString();
        }
    }
    public function getImage() {

        $foregroundColor=new Rgb(0,0,0,0);
        $backgroundAlpha=new Alpha(0,$foregroundColor);
        $fill=Fill::uniformColor($backgroundAlpha, $foregroundColor);

        $style=new RendererStyle(400,4,null,null,$fill);

        $renderer = new ImageRenderer(
            $style,
            new SvgImageBackEnd()
        );


        $writer = new Writer($renderer);

        $sightingURL=$this->getSightingURL();
        // $writer->writeFile('http://127.0.0.1/foundandscan/backend/public/sighting/' . $id, 'qrcode.svg');`
        $svgString = $writer->writeString($sightingURL);
        $image = new SVG(1200, 400);
//die(file_get_contents("/Users/jstaerk/projekte/homepages/foundandscan/shop/wp-content/themes/laratheme/app/Models/fasqrbackground.svg"));
        $img = SVGImage::fromFile("/Users/jstaerk/projekte/homepages/foundandscan/shop/wp-content/themes/laratheme/app/Models/fasqrbackground.svg", "image/svg+xml");
        $image->getDocument()->addChild($img);


        $qr = SVGImage::fromString($svgString,"image/svg+xml",0,3);
        $image->getDocument()->addChild($qr);

        //SVG::addFont(FONTS_DIR . 'Ubuntu-Bold.ttf');
        $text= new \SVG\Nodes\Texts\SVGText($this->code,625,295);

        $text->setFont(new SVGFont("Consolas","./img/Consola.ttf"))
            ->setSize(40);
        $image->getDocument()->addChild($text);


        return $image;
    }
}
