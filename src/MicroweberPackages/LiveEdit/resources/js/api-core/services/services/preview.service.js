import  CSSGUIService from "../../../api-core/services/services/css-gui.service.js";

let isEditMode = true;
let _hascss;


export const previewMode = function () {
    document.documentElement.classList.add('preview');
 
    document.documentElement.style.setProperty('--toolbar-height', '0px');
    mw.app.canvas.getDocument().documentElement.classList.add('mw-le--page-preview');
    mw.app.canvas.getDocument().body.classList.remove('mw-live-edit');

    CSSGUIService.hide();

    document.querySelector('#user-menu-wrapper').classList.remove('active');
 
}

export const liveEditMode = function () {
    document.documentElement.classList.remove('preview');
    document.documentElement.style.setProperty('--toolbar-height', document.documentElement.style.getPropertyValue('--toolbar-static-height'));
    mw.app.canvas.getDocument().documentElement.classList.remove('mw-le--page-preview');
    mw.app.canvas.getDocument().body.classList.add('mw-live-edit');
     
}

mw.app.isPreview = () => {
    return !isEditMode;
}



export const pagePreviewToggle = function () {
    isEditMode = !isEditMode;
    if (!isEditMode) {
        previewMode();
    } else {
        liveEditMode()
    }


    if (!_hascss) {
        _hascss = true;
        var css = `
                html.mw-le--page-preview body{
                    padding-top: 0 !important
                }
                html.mw-le--page-preview .mw-le-spacer,
                html.mw-le--page-preview .mw-le-spacer *,
                html.mw-le--page-preview .mw-le-spacer * *,
                html.mw-le--page-preview .mw-le-resizable{

                    opacity:0 !important;
                    pointer-events: none !important; 
                }


                html.mw-le--page-preview .mw_image_resizer,
                html.mw-le--page-preview #live_edit_toolbar_holder,
                html.mw-le--page-preview .mw-handle-item,
                html.mw-le--page-preview .mw-selector,
                html.mw-le--page-preview .mw_dropable,
                html.mw-le--page-preview .mw-padding-ctrl,
                html.mw-le--page-preview .mw-control-box,
                html.mw-le--page-preview .mw-control-box,
                html.mw-le--page-preview .mw-cloneable-control,
                html.mw-le--page-preview .mw-bg-image-handles,
                html.mw-le--page-preview .mw-small-editor,
                html.mw-le--page-preview #live_edit_toolbar_holder
                {
                    display: none !important
                }
            `

        const node = mw.app.canvas.getDocument().createElement('style');
        node.textContent = css;
        mw.app.canvas.getDocument().body.appendChild(node);
      
    }

}
