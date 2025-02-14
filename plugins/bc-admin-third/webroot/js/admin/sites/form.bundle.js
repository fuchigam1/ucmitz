/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) NPO baser foundation <https://baserfoundation.org/>
 *
 * @copyright     Copyright (c) NPO baser foundation
 * @link          https://basercms.net baserCMS Project
 * @since         5.0.0
 * @license       https://basercms.net/license/index.html MIT License
 */
$((function(){var e=$("#alias").val();function i(){var e=$("#id").val(),i=$("#main-site-id").val();void 0===i&&(i=1);var c=$.bcUtil.apiBaseUrl+"baser-core/sites/get_selectable_devices_and_lang/"+i;void 0!==e&&(c+="/"+e),c+=".json",$.bcUtil.ajax(c,(function(e){var i=$("#device"),c=$("#lang"),n=i.val(),o=c.val();i.find("option").remove(),c.find("option").remove(),e=$.parseJSON(e),$.each(e.devices,(function(e,a){i.append($("<option>").val(e).text(a).prop("selected",e===n))})),$.each(e.langs,(function(e,i){c.append($("<option>").val(e).text(i).prop("selected",e===o))})),a()}),{type:"GET",loaderType:"after",loaderSelector:"#main-site-id"})}function a(){var e=$("#auto-redirect"),i=$("#same-main-url"),a=$("#auto-link"),c=$("#SpanSiteAutoRedirect"),n=$("#SpanSiteAutoLink");$("#device").val()||$("#lang").val()?$("#SectionAccessType").show():($("#SectionAccessType").hide(),e.prop("checked",!1),i.prop("checked",!1),a.prop("checked",!1)),i.prop("checked")?(e.prop("checked",!1),c.hide(),a.prop("checked",!1),n.hide()):(c.show(),"mobile"==$("#device").val()||"smartphone"==$("#device").val()?n.show():n.hide())}$("#BtnSave").click((function(){if(e&&e!=$("#alias").val())return $.bcConfirm.show({title:bcI18n.confirmTitle1,message:bcI18n.confirmMessage2,ok:function(){$.bcUtil.showLoader(),$("#BtnSave").parents("form").submit()}}),!1;$.bcUtil.showLoader()})),$("#main-site-id").change(i),$("#device, #lang").change(a),$('input[name="same_main_url"]').click(a),i()}));
//# sourceMappingURL=form.bundle.js.map