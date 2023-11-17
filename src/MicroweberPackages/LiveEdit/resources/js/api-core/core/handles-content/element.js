import {HandleMenu} from "../handle-menu.js";
import {ElementManager} from "../classes/element.js";
import {HandleIcons} from "../handle-icons";
import {ElementActions} from "./element-actions";
import {DomService} from "../classes/dom";
import {ElementSettingsTarget} from "./element-settings-target";
import {ElementHandleButtonsVisibility} from "./element-handle-buttons-visibility";




export class ElementHandleContent {
    constructor(rootScope) {


        this.root = ElementManager({
            props: {
                id: 'mw-handle-item-element-root'
            }
        });

        this.tools = DomService;
        this.rootScope = rootScope;
        this.settingsTarget = new ElementSettingsTarget(this.rootScope);
        this.handleIcons = new HandleIcons();
        this.elementActions = new ElementActions(this.rootScope);
        this.elementHandleButtonsVisibility = new ElementHandleButtonsVisibility(this.rootScope);

        this.initMenu();


        this.menu.show();


        this.menusHolder = document.createElement('div');
        this.menusHolder.className = 'mw-handle-item-menus-holder';


        var holder = mw.element(this.menusHolder);

        holder.append(this.menu.root);


        this.root.append(this.menusHolder);


    }

    initMenu() {



        const cloneAbleMenu = [
            {
                title: 'Duplicate',
                text: '',
                icon: this.handleIcons.icon('duplicate'),
                className: 'mw-handle-clone-button',
                onTarget: (target, selfNode) => {

                    const isVisible = this.elementHandleButtonsVisibility.shouldShowCloneButton(target);

                    if (isVisible) {
                        selfNode.classList.remove('mw-le-handle-menu-button-hidden');
                    } else {
                        selfNode.classList.add('mw-le-handle-menu-button-hidden');
                    }
                },


                action: (el) => {

                    this.elementActions.cloneElement(el);

                }
            },
            {
                title: 'Move backward',
                text: '',
                icon: this.handleIcons.icon('move-backward'),
                className: 'mw-handle-move-back-button',
                onTarget: (target, selfNode) => {

                    const isVisible = this.elementHandleButtonsVisibility.shouldShowMoveBackwardButton(target);

                    if (isVisible) {
                        selfNode.classList.remove('mw-le-handle-menu-button-hidden');
                    } else {
                        selfNode.classList.add('mw-le-handle-menu-button-hidden');
                    }
                },
                action: (el) => {
                    this.elementActions.moveBackward(el);
                }
            },
            {
                title: 'Move forward',
                text: '',
                icon: this.handleIcons.icon('move-forward'),

                className: 'mw-handle-move-back-button',
                onTarget: (target, selfNode) => {

                    const isVisible =  this.elementHandleButtonsVisibility.shouldShowMoveForwardButton(target);

                    if (isVisible) {
                        selfNode.classList.remove('mw-le-handle-menu-button-hidden');
                    } else {
                        selfNode.classList.add('mw-le-handle-menu-button-hidden');
                    }
                },
                action: (el) => {
                    this.elementActions.moveForward(el);
                }
            },
        ];
        const elementResetImageSizeMenu = [
            {
                title: 'Reset Image Size',
                text: '',
                icon: this.handleIcons.icon('reset-image-size'),

                className: 'mw-handle-reset-image-button',

                action: (el) => {
                    this.elementActions.resetImageSize(el);
                },
                onTarget: (target, selfBtn) => {
                    var selfVisible =  this.elementHandleButtonsVisibility.shouldShowResetImageSizeButton(target);

                    selfBtn.classList[selfVisible ? 'remove' : 'add']('mw-le-handle-menu-button-hidden');
                },

            },
            {
                title: 'Fit Image',
                text: '',
                icon: this.handleIcons.icon('image-fit'),

                className: 'mw-handle-fit-image-button',

                action: (el) => {
                    el.style.objectFit = 'contain';
                    el.dataset.objectFit = 'contain';
                },
                onTarget: (target, selfBtn) => {
                    var selfVisible =  this.elementHandleButtonsVisibility.shouldShowFitImageButton(target);

                    selfBtn.classList[selfVisible ? 'remove' : 'add']('mw-le-handle-menu-button-hidden');
                },

            },
            {
                title: 'Fill Image',
                text: '',
                icon: this.handleIcons.icon('image-fill'),

                className: 'mw-handle-fill-image-button',

                action: (el) => {
                    el.style.objectFit = 'cover';
                    el.dataset.objectFit = 'cover';
                },
                onTarget: (target, selfBtn) => {
                    var selfVisible = this.elementHandleButtonsVisibility.shouldShowFitImageButton(target);

                    selfBtn.classList[selfVisible ? 'remove' : 'add']('mw-le-handle-menu-button-hidden');
                },

            },

        ];


        const elementLinkMenu = [
            {
                title: 'Link',
                text: '',
                icon: this.handleIcons.icon('link'),

                className: 'mw-handle-element-link-button',

                action: (el) => {
                    this.elementActions.editLink(el);
                },
                onTarget: (target, selfBtn) => {
                    var selfVisible =   this.elementHandleButtonsVisibility.shouldShowLinkButton(target);

                    selfBtn.style.display = selfVisible ? '' : 'none';
                },

            },

            {
                title: 'Unlink',
                text: '',
                icon: this.handleIcons.icon('unlink'),

                className: 'mw-handle-element-unlink-button',

                action: (el) => {
                    this.elementActions.removeLink(el);
                },
                onTarget: (target, selfBtn) => {
                    var selfVisible =  this.elementHandleButtonsVisibility.shouldShowUnlinkButton(target);
                    selfBtn.style.display = selfVisible ? '' : 'none';
                },

            },

        ];

        const elementLinkMenuGroup = [
            {
                title: 'Link',
                icon: this.handleIcons.icon('link'),
                menu: elementLinkMenu

            },
        ];


        const elementEditStyleMenu = [
            {
                title: 'Style Editor',
                text: '',
                icon: this.handleIcons.icon('style-editor'),

                className: 'mw-handle-element-open-style-editor-button',

                action: (el) => {
                    this.elementActions.openElementStyleEditor(el);
                },
                onTarget: (target, selfBtn) => {
                    var selfVisible = this.elementHandleButtonsVisibility.shouldShowStyleEditorButton(target);
                    selfBtn.style.display = selfVisible ? '' : 'none';
                },

            }

        ];
        const elementBackgroundImageMenu = [
            {
                title: 'Background Image',
                text: '',
                icon: this.handleIcons.icon('background-image'),

                className: 'mw-handle-element-open-background-image-editor-button',

                action: (el) => {

                    this.elementActions.editBackgroundImage(el);


                },
                onTarget: (target, selfBtn) => {
                    var selfVisible = this.elementHandleButtonsVisibility.shouldShowBackroundImageEditorButton(target);
                    selfBtn.style.display = selfVisible ? '' : 'none';
                },
            }
        ];
        const elementBackgroundImageMenuOnMoreButton = [
            {
                title: 'Background Image',
                text: '',
                icon: this.handleIcons.icon('background-image'),

                className: 'mw-handle-element-open-background-image-editor-button',

                action: (el) => {

                    this.elementActions.editBackgroundImage(el);


                },
                onTarget: (target, selfBtn) => {
                    var selfVisible = this.elementHandleButtonsVisibility.shouldShowBackroundImageEditorButtonOnTheMoreButton(target);
                    selfBtn.style.display = selfVisible ? '' : 'none';
                },
            }
        ];

        const primaryMenu = [
            {
                title: 'Drag',
                text: '',
                icon: this.handleIcons.icon('drag'),
                className: 'mw-handle-drag-button mw-handle-drag-button-element',
                action: () => {
                },
                onTarget: (target, selfBtn) => {
                    var selfVisible =  this.elementHandleButtonsVisibility.shouldShowDragButton(target);
                    selfBtn.style.display = selfVisible ? '' : 'none';
                },

            },

            {
                title: 'Edit',
                text: '',
                icon: this.handleIcons.icon('edit'),

                className: 'mw-handle-edit-button',

                action: (el) => {

                    this.elementActions.editElement(el);
                },
                onTarget: (target, selfBtn) => {
                    var selfVisible =  this.elementHandleButtonsVisibility.shouldShowEditButton(target);


                    selfBtn.style.display = selfVisible ? '' : 'none';
                },

            },

            {
                title: 'Insert module',
                text: '',
                icon: this.handleIcons.icon('plus'),
                className: 'mw-handle-add-button',

                onTarget: (target, selfBtn) => {
                    var selfVisible =  this.elementHandleButtonsVisibility.shouldShowInsertModuleButton(target);


                    selfBtn.style.display = selfVisible ? '' : 'none';
                },

                action: (el) => {

                    mw.app.editor.dispatch('insertModuleRequest', el);

                }
            },
            ...elementLinkMenu,
            ...elementEditStyleMenu,
            ...elementBackgroundImageMenu,
            // ...elementLinkMenuGroup,
            {
                title: 'Settings',
                text: '',
                icon: this.handleIcons.icon('settings'),
                className: 'mw-handle-settings-button',

                action: (el) => {
                    mw.app.editor.dispatch('elementSettingsRequest', el);

                },
                onTarget: (target, selfBtn) => {
                    var selfVisible =  this.elementHandleButtonsVisibility.shouldShowSettingsButton(target);


                    selfBtn.style.display = selfVisible ? '' : 'none';
                }
            },
            {
                title: 'Background color',
                text: '',
                icon: this.handleIcons.icon('color'),
                className: 'mw-handle-insert-color-button',

                action: function (el, selfBtn) {
                    this.elementActions.editBackgroundColor(el, selfBtn);

                },
                onTarget: (target, selfBtn) => {
                    var selfVisible =  this.elementHandleButtonsVisibility.shouldShowEditBackgroundColorButton(target);
                    if(selfVisible) {
                        selfBtn.querySelector('.mw-le--handle-icon--color-color').style.backgroundColor = getComputedStyle(target).backgroundColor;
                    }

                    selfBtn.style.display = selfVisible ? '' : 'none';
                }
            },

            // ...cloneAbleMenu,
            //  ...elementImageMenu,


        ]

        const tailMenuQuickSettings = [
            {
                title: 'Quick Settings',
                icon: this.handleIcons.icon('more'),
                menu: [
                    {
                        name: 'Cloneable',

                        nodes: cloneAbleMenu,

                    },
                    {
                        name: 'Image settings',
                        nodes:
                        elementResetImageSizeMenu

                    },
                    {
                        name: 'Image Background',
                        nodes:
                        elementBackgroundImageMenuOnMoreButton

                    },
                ]
            },
        ];


        const tail = [
            {
                title: this.rootScope.lang('Delete'),
                text: '',
                icon: this.handleIcons.icon('delete'),
                className: 'mw-handle-delete-button',
                action: (el) => {
                    this.elementActions.deleteElement(el);
                },
                onTarget: (target, selfBtn) => {
                    let selfVisible =  this.elementHandleButtonsVisibility.shouldShowDeleteElementButton(target);

                    if(selfVisible) {

                        selfBtn.classList.remove('mw-le-handle-menu-button-hidden');
                    } else {
                        selfBtn.classList.add('mw-le-handle-menu-button-hidden');
                    }
                }
            }
        ]

        this.menu = new HandleMenu({
            id: 'mw-handle-item-element-menu',
            title: 'Element',
            handleScope: this,

            menus: [
                {
                    name: 'primary',
                    nodes: primaryMenu
                },
                {
                    name: 'dynamic',
                    nodes: []
                },
                {
                    name: 'cloneAbleMenu',
                    nodes: cloneAbleMenu
                },
                {
                    name: 'Image settings',
                    nodes: elementResetImageSizeMenu

                },

                {
                    name: 'tail',
                    nodes: tail
                },
                {
                    name: 'tailMenuQuickSettings',
                    nodes: tailMenuQuickSettings
                },

            ],

        });
        // Rest of your initMenu code here
    }
}






