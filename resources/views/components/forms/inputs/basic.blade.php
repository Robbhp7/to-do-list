@props([
    'formId' => 'basic-form',
    'id' => null,
    'type' => 'text',
    'class' => '',
    'name' => null,
    'value' => null,
    'required' => false,
    'label' => null,
    'placeholder' => null,
])
<?php
$formId = $formId ?? 'basic-form';
$id = $id ?? $formId.'-'.$name;
$required = $required ?? false;
$type = $type ?? 'text';
$placeholder = $placeholder ?? $label;
?>
<div class="form-floating mb-3">
    <input type="{{$type}}" class="form-control" name="{{$name}}" id="{{$id}}" placeholder="{{$placeholder}}" @if($required) required @endif>
    <label for="{{$id}}">{{$label}}</label>
</div>
