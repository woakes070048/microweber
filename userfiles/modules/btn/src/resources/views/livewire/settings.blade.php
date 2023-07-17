<div class="px-2 py-2" x-data="{
showEditTab: 'content',
showAdvancedDesign: false
}">

    <div class="d-flex justify-content-between align-items-center mb-4 collapseNav-initialized">
        <div class="d-flex flex-wrap gap-md-4 gap-3">
            <a href="#" x-on:click="showEditTab = 'content'" :class="{ 'active': showEditTab == 'content' }"
               class="btn btn-link text-decoration-none mw-admin-action-links mw-adm-liveedit-tabs active">
                Content
            </a>
            <a href="#" x-on:click="showEditTab = 'design'" :class="{ 'active': showEditTab == 'design' }"
               class="btn btn-link text-decoration-none mw-admin-action-links mw-adm-liveedit-tabs">
               Design
            </a>
        </div>
    </div>

    <div x-show="showEditTab=='content'">
        <div>
            Text
            <livewire:microweber-module-option::text optionName="text" :moduleId="$moduleId" :moduleType="$moduleType"  />
        </div>
        <div class="mt-4 mb-3">
            <label class="form-label">Link</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control mw_option_field js-btn-link-value" option_group="{{$moduleId}}" placeholder="https://example.com">
                <button class="btn js-open-link-editor" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="currentColor" d="M1.911 7.383a8.491 8.491 0 0 1 1.78-3.08a.5.5 0 0 1 .54-.135l1.918.686a1 1 0 0 0 1.32-.762l.366-2.006a.5.5 0 0 1 .388-.4a8.532 8.532 0 0 1 3.554 0a.5.5 0 0 1 .388.4l.366 2.006a1 1 0 0 0 1.32.762l1.919-.686a.5.5 0 0 1 .54.136a8.491 8.491 0 0 1 1.78 3.079a.5.5 0 0 1-.153.535l-1.555 1.32a1 1 0 0 0 0 1.524l1.555 1.32a.5.5 0 0 1 .152.535a8.491 8.491 0 0 1-1.78 3.08a.5.5 0 0 1-.54.135l-1.918-.686a1 1 0 0 0-1.32.762l-.366 2.007a.5.5 0 0 1-.388.399a8.528 8.528 0 0 1-3.554 0a.5.5 0 0 1-.388-.4l-.366-2.006a1 1 0 0 0-1.32-.762l-1.918.686a.5.5 0 0 1-.54-.136a8.49 8.49 0 0 1-1.78-3.079a.5.5 0 0 1 .152-.535l1.555-1.32a1 1 0 0 0 0-1.524l-1.555-1.32a.5.5 0 0 1-.152-.535Zm1.06-.006l1.294 1.098a2 2 0 0 1 0 3.05l-1.293 1.098c.292.782.713 1.51 1.244 2.152l1.596-.57a2 2 0 0 1 2.64 1.525l.305 1.668a7.556 7.556 0 0 0 2.486 0l.304-1.67a1.998 1.998 0 0 1 2.641-1.524l1.596.571a7.492 7.492 0 0 0 1.245-2.152l-1.294-1.098a1.998 1.998 0 0 1 0-3.05l1.294-1.098a7.491 7.491 0 0 0-1.245-2.152l-1.596.57a2 2 0 0 1-2.64-1.524l-.305-1.669a7.555 7.555 0 0 0-2.486 0l-.304 1.669a2 2 0 0 1-2.64 1.525l-1.597-.571a7.491 7.491 0 0 0-1.244 2.152ZM7.502 10a2.5 2.5 0 1 1 5 0a2.5 2.5 0 0 1-5 0Zm1 0a1.5 1.5 0 1 0 3 0a1.5 1.5 0 0 0-3 0Z"/></svg>
                </button>
            </div>
        </div>

        <script>
            $(document).ready(function() {
               $('.js-open-link-editor').click(function () {
                   new mw.LinkEditor({
                       mode: 'dialog'
                   }).promise()
                       .then(function (result){
                           $('.js-btn-link-value').val(result.url);
                           $('.js-btn-link-value').trigger('change');
                       });
               });
            });
        </script>

    </div>
    <div x-show="showEditTab=='design'">

        <livewire:microweber-live-edit::module-select-template :moduleId="$moduleId" :moduleType="$moduleType"/>

        <div class="mt-3">
          <x-microweber-ui::icon-picker wire:model="settings.icon" :value="$settings['icon']"/>
      </div>

       <div class="mt-3">
           <x-microweber-module-btn::btn-align :settings="$settings"/>
       </div>

        <div class="mt-3">
           <button x-on:click="showAdvancedDesign =! showAdvancedDesign" type="button" class="btn btn-link btn-sm">
               {{__('Advanced design')}}
           </button>
        </div>

        <div x-show="showAdvancedDesign" x-transition>
            <livewire:microweber-module-btn::settings-form-design :moduleId="$moduleId" :moduleType="$moduleType" />
        </div>
    </div>

</div>
