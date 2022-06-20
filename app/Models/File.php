<?php

namespace App\Models;

use App\Events\FileDeleted;
use App\Events\FileUploaded;
use App\Scopes\OwnerScope;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\True_;

class File extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'files';
    protected $fillable = ['type_id', 'contract_id', 'creator_id', 'fixture_id', 'note_id', 'outgoing_id', 'payment_id', 'unit_id'];

    protected $primaryKey = 'id';

    const FILE_TYPE_UNIT_CONTRACT = 1;
    const FILE_TYPE_PAYMENT = 2;
    const FILE_TYPE_PAYMENT_DEPT = 7;
    const FILE_TYPE_OUTGOING = 3;
    const FILE_TYPE_PERSON = 4;
    const FILE_TYPE_FIXTURE = 5;
    const FILE_TYPE_NOTES = 6;


    protected static function booted()
    {
        static::addGlobalScope(new OwnerScope);
    }

    protected $dispatchesEvents = [
        'updated' => FileUploaded::class,
        'deleted' => FileDeleted::class
    ];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function creator()
    {
        return $this->hasOne('App\Models\User', 'id', 'creator_id');
    }


    function getType($badge = false, $pluralNoun = false)
    {

        switch ($this->type_id) {
            case self::FILE_TYPE_UNIT_CONTRACT:
                $name = __('dashboard.contract');
                $names = __('dashboard.contracts');
                $badgeClass = 'badge-success';
                break;
            case self::FILE_TYPE_PAYMENT:
                $name = __('dashboard.payment');
                $names = __('dashboard.payments');
                $badgeClass = 'badge-success';
                break;
            case self::FILE_TYPE_OUTGOING:
                $name = __('dashboard.outgoing');
                $names = __('dashboard.outgoings');
                $badgeClass = 'badge-success';
                break;
            case self::FILE_TYPE_PERSON:
                $name = __('dashboard.person');
                $names = __('dashboard.persons');
                $badgeClass = 'badge-success';
                break;
            case self::FILE_TYPE_FIXTURE:
                $name = __('dashboard.fixture');
                $names = __('dashboard.fixtures');
                $badgeClass = 'badge-success';
                break;
            case self::FILE_TYPE_NOTES:
                $name = __('dashboard.note');
                $names  = __('dashboard.notes');
                $badgeClass = 'badge-success';
                break;
        }
        if($pluralNoun){
            $name = $names;
        }

        if ($badge) {
            $result = "<span class='badge $badgeClass'>$name</span>";
        } else {
            $result = $name;
        }

        return $result;

    }

    static function getTypes()
    {
        $types = [
            self::FILE_TYPE_UNIT_CONTRACT => ['id' => self::FILE_TYPE_UNIT_CONTRACT, 'name' => __('dashboard.contract'),'names'=>__('dashboard.contracts')],
            self::FILE_TYPE_PAYMENT => ['id' => self::FILE_TYPE_PAYMENT, 'name' => __('dashboard.payment'),'names'=>__('dashboard.payments')],
            self::FILE_TYPE_OUTGOING => ['id' => self::FILE_TYPE_OUTGOING, 'name' => __('dashboard.outgoing'),'names'=>__('dashboard.outgoings')],
            self::FILE_TYPE_PERSON => ['id' => self::FILE_TYPE_PERSON, 'name' => __('dashboard.person'),'names'=>__('dashboard.persons')],
            self::FILE_TYPE_FIXTURE => ['id' => self::FILE_TYPE_FIXTURE, 'name' => __('dashboard.fixture'),'names'=>__('dashboard.fixtures')],
            self::FILE_TYPE_NOTES => ['id' => self::FILE_TYPE_NOTES, 'name' => __('dashboard.nots'),'names'=>__('dashboard.nots')],
        ];

        return $types;

    }

    public function getExtensionTypeAttribute()
    {
        $path = pathinfo($this->name, PATHINFO_EXTENSION);
        switch ($path) {
            case (preg_match('/(pdf)/i', $path) ? true : false):
                return 'pdf';
            case (preg_match('/(docx?|xlsx?|pptx?|pps|potx?)/i', $path) ? true : false):
                return 'office';
            case (preg_match('/(rtf|docx?|xlsx?|pptx?|pps|potx?|ods|odt|pages|ai|dxf|ttf|tiff?|wmf|e?ps)/i', $path) ? true : false):
                return 'gdocs';
            case (preg_match('/(gif|png|jpe?g|tiff?|wmf)/i', $path) ? true : false):
                return 'image';
            case (preg_match('/(txt|md|nfo|php|ini)/i', $path) ? true : false):
                return 'text';


        }

//        image: function(vType, vName) {
//            return (typeof vType !== "undefined") ? vType.match('image.*') && !vType.match(/(tiff?|wmf)$/i) : vName.match(/\.(gif|png|jpe?g)$/i);
//    },
//        html: function(vType, vName) {
//            return (typeof vType !== "undefined") ? vType == 'text/html' : vName.match(/\.(htm|html)$/i);
//    },
//        office: function (vType, vName) {
//            return vType.match(/(word|excel|powerpoint|office)$/i) ||
//            vName.match(/\.(docx?|xlsx?|pptx?|pps|potx?)$/i);
//    },
//        gdocs: function (vType, vName) {
//            return vType.match(/(word|excel|powerpoint|office|iwork-pages|tiff?)$/i) ||
//            vName.match(/\.(rtf|docx?|xlsx?|pptx?|pps|potx?|ods|odt|pages|ai|dxf|ttf|tiff?|wmf|e?ps)$/i);
//    },
//        text: function(vType, vName) {
//            return typeof vType !== "undefined" && vType.match('text.*') || vName.match(/\.(txt|md|nfo|php|ini)$/i);
//    },
//        video: function (vType, vName) {
//            return typeof vType !== "undefined" && vType.match(/\.video\/(ogg|mp4|webm)$/i) || vName.match(/\.(og?|mp4|webm)$/i);
//    },
//        audio: function (vType, vName) {
//            return typeof vType !== "undefined" && vType.match(/\.audio\/(ogg|mp3|wav)$/i) || vName.match(/\.(ogg|mp3|wav)$/i);
//    },
//        flash: function (vType, vName) {
//            return typeof vType !== "undefined" && vType == 'application/x-shockwave-flash' || vName.match(/\.(swf)$/i);
//    },
//        object: function (vType, vName) {
//            return true;
//        },
//        other: function (vType, vName) {
//            return true;
//        },


    }

}
