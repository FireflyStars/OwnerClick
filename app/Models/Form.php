<?php


namespace App\Models;


class Form
{
    static function input($name, $model, $errors, $required = true)
    {
        $divClass = '';
        $inputClass = '';
        $errorDiv = '';
        if ($errors->has($name)) {
            $divClass = ' has-danger';
            $inputClass = ' is-invalid';
            $errorDiv = self::error($name, $errors->first($name));
        }
        if($required){
            $requiredString = 'required';
        }else{
            $requiredString = '';
        }
        $html = '<div class="form-group bmd-form-group' . $divClass . '">
                 <input name="' . $name . '" type="text" class="form-control' . $inputClass . '"
                 value="' . old($name.".0",$model->{rtrim($name,"[]") }). '"'. $requiredString . ' aria-required="' . (string)$requiredString . '">' . $errorDiv . '</div>';

        return $html;
    }

    static function inputNumber($name, $model, $errors, $required = true)
    {
        $divClass = '';
        $inputClass = '';
        $errorDiv = '';
        if ($errors->has($name)) {
            $divClass = ' has-danger';
            $inputClass = ' is-invalid';
            $errorDiv = self::error($name, $errors->first($name));
        }
        if($required){
            $requiredString = 'required';
        }else{
            $requiredString = '';
        }
        $html = '<div class="form-group bmd-form-group' . $divClass . '">
                 <input name="' . $name . '" type="number" class="form-control' . $inputClass . '"
                 value="' . old($name.".0",$model->{rtrim($name,"[]") }). '"'. $requiredString . ' aria-required="' . (string)$requiredString . '">' . $errorDiv . '</div>';

        return $html;
    }

    static function inputDate($name, $model, $errors, $required = true)
    {
        $divClass = '';
        $inputClass = '';
        $errorDiv = '';
        if ($errors->has($name)) {
            $divClass = ' has-danger';
            $inputClass = ' is-invalid';
            $errorDiv = self::error($name, $errors->first($name));
        }
        $html = '<div class="form-group bmd-form-group' . $divClass . '">
                 <input name="' . $name . '" type="text" class="form-control datetimepicker ' . $inputClass . '"
                 value="' . old($name.".0",$model->{rtrim($name,"[]") }). '" required="' . $required . '" aria-required="' . $required . '">' . $errorDiv . '</div>';


        return $html;
    }

    static function inputTime($name, $model, $errors, $required = true)
    {
        $divClass = '';
        $inputClass = '';
        $errorDiv = '';
        if ($errors->has($name)) {
            $divClass = ' has-danger';
            $inputClass = ' is-invalid';
            $errorDiv = self::error($name, $errors->first($name));
        }
        $html = '<div class="form-group bmd-form-group' . $divClass . '">
                 <input name="' . $name . '" type="text" class="form-control timepicker ' . $inputClass . '"
                 value="' . old($name.".0",$model->{rtrim($name,"[]") }). '" required="' . $required . '" aria-required="' . $required . '">' . $errorDiv . '</div>';


        return $html;
    }


    static function select($name, $options, $model, $errors, $liveSearch = true, $required = true,$title = null)
    {
        $divClass = '';
        $errorDiv = '';
        if ($errors->has($name)) {
            $divClass = ' has-danger';
            $errorDiv = self::error($name, $errors->first($name));
        }
        $errorJS = '<label for="'.$name.'" generated="true" class="error"></label>';

        if($required){
            $requiredString = 'required';
        }else{
            $requiredString = '';
        }

        $html = '<div class="form-group bmd-form-group' . $divClass . '">
                 <select name="' . $name . '" id="' . $name . '"class="form-control selectpicker"
                 data-style="btn btn-link" data-live-search="' . $liveSearch . '" ' . $requiredString . ' aria-required="' . (string)$requiredString . '" title="' . $title . '">';


        foreach ($options as $value) {
            if(!isset($value['id'])){
                $value['id'] = $value['name'];
            }
            if (\Illuminate\Support\Facades\Request::old($name, $model->{rtrim($name,"[]")}) === $value['id'])
                $html .= '<option value="' . $value['id'] . '" selected>' . $value['name'] . '</option>';
            else
                $html .= '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
        }
        $html .= "</select>$errorDiv$errorJS</div>";
        return $html;
    }

    static function selectAjax($name, $url, $model, $errors, $liveSearch = true, $required = true)
    {
        $divClass = '';
        $errorDiv = '';
        $urlTag = '';
        if ($errors->has($name)) {
            $divClass = ' has-danger';
            $errorDiv = self::error($name, $errors->first($name));
        }
        if ($url != null) {
            $urlTag = 'data-select-url="' . $url . '"';
        }

        $html = '<div class="form-group bmd-form-group' . $divClass . '">
                                            <select name="' . $name . '" class="form-control ajax-selectpicker"
                                                    data-style="btn btn-link"
                                                    data-live-search-normalize="true"
                                                    data-live-search="' . $liveSearch . '" ' . $urlTag . '
                                                    id="' . $name . '" required="' . $required . '" aria-required="' . $required . '"
                                                    data-old-value="' . old($name, $model->{$name}) . '">
                                            </select>' . $errorDiv . '</div>';
        return $html;

    }


    static function option($name, $options, $model, $errors, $required = true)
    {
        $divClass = '';
        $inputClass = '';
        $errorDiv = '';
        if ($errors->has($name)) {
            $divClass = ' has-danger';
            $inputClass = ' is-invalid';
            $errorDiv = self::error($name, $errors->first($name));
        }

        $html = '<div class="form-group bmd-form-group' . $divClass . '">';


        foreach ($options as $key => $value) {
            $html .= '<div class="form-check form-check-inline">
                      <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="' . $name . '" value="' . $key . '"';
            if (\Illuminate\Support\Facades\Request::old($name, $model->{$name}) == $key) {
                $html .= 'checked="checked"';
            }
            $html .= '/>' . $value . '<span class="circle"><span class="check"></span></span></label></div>';
        }

        $html .= '</div>' . $errorDiv;

return $html;
    }


    static function textArea($name, $model, $errors, $required = true){
        $divClass = '';
        $inputClass = '';
        $errorDiv = '';
        if ($errors->has($name)) {
            $divClass = ' has-danger';
            $inputClass = ' is-invalid';
            $errorDiv = self::error($name, $errors->first($name));
        }
        if($required){
            $requiredString = 'required';
        }else{
            $requiredString = '';
        }
        $html = '<div class="form-group bmd-form-group'.$divClass.'">
                                            <textarea name="'.$name.'"
                                                      class="form-control'.$inputClass.'"
                                                      rows="3" '.$requiredString.'
                                                      aria-required="'.(string)$requiredString.'">'. old($name,$model->{$name}) .'</textarea>
        '.$errorDiv.'</div>';

        return $html;

    }


    static function error($name, $message)
    {
        return '<span id="' . $name . '-error" class="error text-danger" for="input-' . $name . '">' . $message . '</span>';
    }


}
