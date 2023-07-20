<div class="px-2 py-2" x-data="{
showMainEditTab: 'mainSettings'
}">

    <?php
    $moduleTemplates = module_templates($moduleType);

    $editorSettings = [
        'config' => [
            'title' => 'Teamcard',
            'icon' => 'mdi mdi-account-group',
            'addButtonText' => 'New Member',
            'addButtonIconSvg' => '<svg fill="currentColor" class="me-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M446.667 856V609.333H200v-66.666h246.667V296h66.666v246.667H760v66.666H513.333V856h-66.666Z"></path></svg>',
            'editButtonText' => 'Edit team member',
            'deleteButtonText' => 'Delete team member',
            'sortItems' => true,
            'settingsKey' => 'settings',
            'listColumns' => [
                'name' => 'Name',
                'bio' => 'Bio',
                'role' => 'Role',
                'website' => 'Website',
            ],
        ],
        'schema' => [
            [
                'type' => 'text',
                'label' => 'Team member name',
                'name' => 'name',
                'placeholder' => 'Enter name',
                'help' => 'Enter Name',
            ],  [
                'type' => 'image',
                'label' => 'Team member picture',
                'placeholder' => 'Team member picture',
                'name' => 'file',

            ], [
                'type' => 'textarea',
                'label' => 'Team member bio',
                'name' => 'bio',
                'placeholder' => 'Enter bio',
                'help' => 'Enter bio',
            ]
            , [
                'type' => 'text',
                'label' => 'Team member role',
                'name' => 'role',
                'placeholder' => 'Enter role',
                'help' => 'Enter role',
            ]
            , [
                'type' => 'text',
                'label' => 'Team member website',
                'name' => 'website',
                'placeholder' => 'Enter website',
                'help' => 'Enter website',
            ]
        ]
    ];

    ?>



@if($moduleTemplates && count($moduleTemplates) >  1)
    <div class="d-flex justify-content-between align-items-center mb-4 collapseNav-initialized">
        <div class="d-flex flex-wrap gap-md-4 gap-3">
            <button   x-on:click="showMainEditTab = 'mainSettings'" :class="{ 'active': showMainEditTab == 'mainSettings' }"
                      class="btn btn-link text-decoration-none mw-admin-action-links mw-adm-liveedit-tabs active">
                @lang('Main settings')
            </button>
            <button   x-on:click="showMainEditTab = 'design'" :class="{ 'active': showMainEditTab == 'design' }"
                      class="btn btn-link text-decoration-none mw-admin-action-links mw-adm-liveedit-tabs">
                @lang('Design')
            </button>
        </div>
    </div>
@endif

    <div x-show="showMainEditTab=='mainSettings'" x-transition:enter="tab-pane-slide-left-active">






        <livewire:microweber-live-edit::module-items-editor :moduleId="$moduleId" :moduleType="$moduleType" :editorSettings="$editorSettings"/>

        <?php

        /*<livewire:microweber-module-teamcard::list-items :moduleId="$moduleId" :moduleType="$moduleType"  />*/
        ?>

    </div>


    @if($moduleTemplates && count($moduleTemplates) >  1)

    <div x-show="showMainEditTab=='design'" x-transition:enter="tab-pane-slide-right-active">

      <div>
          <livewire:microweber-live-edit::module-select-template :moduleId="$moduleId" :moduleType="$moduleType"/>
      </div>
    </div>

    @endif
</div>