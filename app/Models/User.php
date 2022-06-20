<?php

namespace App\Models;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use NotificationChannels\WebPush\HasPushSubscriptions;
use Spatie\Permission\Traits\HasRoles;
use Thomasjohnkane\Snooze\Traits\SnoozeNotifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,SnoozeNotifiable;

    use HasRoles;
    use HasPushSubscriptions;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','language','location','currency','confirm_profile_at','timezone','date_format','time_format','avatar', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'confirm_profile_at' => 'datetime',
    ];

    protected $appends = ['confirm_profile_at'];

//    public function getConfirmProfileAtAttribute(){
//
//    }


    public function publicData(){
        return [
            'name' => $this->name,
            'email' => $this->email,
            'language' => $this->language,
            'location' => $this->location,
            'locationIso2' => explode('_',explode('-', $this->language)[0])[0],
            'currency' => $this->currency,
            'timezone' => $this->timezone,
            'date_format' => $this->date_format,
            'date_format_js' => DateTime::getJavascriptDateFormats()[$this->date_format],
            'time_format' => $this->time_format,
            'provider' => $this->provider,
            'avatar' => $this->avatar,
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function person()
    {
        return $this->hasOne(Person::class,'user_id','id');
    }


    public function socialAccounts(){
        return $this->hasMany(SocialAccount::class);
    }

    /**
     * The channels the user receives notification broadcasts on.
     *
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        return 'App.User.'.$this->id;
    }

    /**
     * @param string $name
     * @return string
     */
    public function generateInitialsFromName(string $name) : string{
        $words = explode(' ', $name);
        if (count($words) >= 2) {
            return mb_strtoupper(mb_substr($words[0], 0, 1) . mb_substr(end($words), 0, 1));
        }
        preg_match_all('#([A-Z]+)#', $name, $capitals);
        if (count($capitals[1]) >= 2) {
            return mb_strtoupper(mb_substr(implode('', $capitals[1]), 0, 2));
        }
        return mb_strtoupper(mb_substr($name, 0, 2));
    }

    public static function createAvatarFromName($nameText){
        $colors = ['#00AA55', '#009FD4', '#B381B3', '#939393', '#E3BC00', '#D47500', '#DC2A2A'];
        $img = Image::canvas(300, 300, $colors[array_rand($colors)]);
        $img->text($nameText, 150, 150, function ($font) {
            $fonts = resource_path('fonts/Roboto-Medium.ttf');
            $font->file($fonts);
            $font->size(150);
            $font->color('#ffffff');
            $font->align('center');
            $font->valign('center');
//            $font->angle(45);
        });
        $filename = Str::random(9)."-".auth()->id().'.jpg';
        $img->save(Storage::disk('public')->path('avatars').'/'.$filename,90);
        return $filename;
    }

    public function getAvatarAttribute($avatar){
        if(is_null($avatar) OR $avatar == ""){
            $nameText = \auth()->user()->generateInitialsFromName($this->name);
            $this->avatar= $avatar  = User::createAvatarFromName($nameText);
            $this->update(['avatar']);
        }
       return asset('storage/avatars/'.$avatar);
    }


}
