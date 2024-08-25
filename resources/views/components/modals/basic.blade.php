@props([
    'id' => 'basic-modal',
    'formId' => 'basic-form',
    'title' => 'Modal title',
    'btnSubmitText' => 'Save',
    'btnCloseText' => 'Close',
    'btnSubmitIcon' => null,
    'body' => '',
])
<div class="modal fade" tabindex="-1" id="{{$id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include($body)
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{$btnCloseText}}</button>
                <button type="button" class="btn btn-primary">@if($btnSubmitIcon)<i class="{{$btnSubmitIcon}}"></i> @endif{{$btnSubmitText}}</button>
            </div>
        </div>
    </div>
</div>
