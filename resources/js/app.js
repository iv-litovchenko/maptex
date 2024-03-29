/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
global.jquery = global.jQuery = global.$ = require('jquery/dist/jquery');
require('bootstrap/dist/js/bootstrap'); // Bootstrap

const hljs = require('highlight.js/lib/common'); // Highlight.Js
const tinymce = require('tinymce/tinymce'); // TinyMCE

require('tinymce/icons/default');
require('tinymce/models/dom');
require('tinymce/themes/silver');
require('tinymce/plugins/advlist');
require('tinymce/plugins/autolink');
require('tinymce/plugins/lists');
require('tinymce/plugins/link');
require('tinymce/plugins/anchor');
require('tinymce/plugins/table');
require('tinymce/plugins/code');
require('tinymce/plugins/codesample');

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
// Визуальный редактор
tinymce.baseURL = window.location.protocol + '//' + window.location.host;
tinymce.init({
    selector: '#tinymce',
    menubar: true,
    height: 500,
    plugins: 'lists advlist table link code codesample',
    toolbar1: 'undo redo | removeformat | formatselect fontselect fontsizeselect |' +
    'styleselect backcolor forecolor |' +
    'bold italic strikethrough underline |' +
    'alignleft aligncenter alignjustify alignright',
    toolbar2: 'outdent indent bullist numlist |' +
    'quicktable quicklink | table | link codesample code',
    // 'tableprops tablerowprops tablecellprops | ' +
    // 'tableinsertrowbefore tableinsertrowafter | ' +
    // 'tableinsertcolbefore tableinsertcolafter ',
    codesample_languages: [
        {text: 'Plain', value: 'plaintext'},
        {text: 'HTML/XML', value: 'xml'},
        {text: 'JavaScript', value: 'javascript'},
        {text: 'CSS', value: 'css'},
        {text: 'PHP', value: 'php'},
        {text: 'SQL', value: 'sql'},
        {text: 'Markdown', value: 'markdown'},
        {text: 'Lua', value: 'lua'},
        {text: 'JSON', value: 'json'},
        {text: 'YAML', value: 'yaml'},
        {text: 'C/C++', value: 'c'},
        // {text: 'UML', value: ''} ???
    ]
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// Подсветка синтаксиса
// html = hljs.highlight('<h1>Hello World!</h1>', {language: 'xml'}).value
$("pre[class^='language']").each(function () {
    var content = $(this).text();
    var codeLanguage = $(this).attr('class');
    codeLanguage = codeLanguage.replace('language-', '');
    var hljsContent = hljs.highlight(content, {language: codeLanguage}).value;
    $(this).html(hljsContent);
    $(this).css('border', 'none');
    $(this).css('border-radius', 'none');
    // alert(codeLanguage + ' : ' + hljsContent);
});

// Подсветка текста в разделе поиск
// var qSearchValue = $('#qSearch').val();
// $('.backlightText').html(function () {
//     return $(this).html().replace(new RegExp(qSearchValue + "(?=[^>]*<)", "ig"), "<span class='search-sot'>$&</span>");
// });

window.Vue = require('vue').default;
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
const app = new Vue({
    el: '#app',
});
