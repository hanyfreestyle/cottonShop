<script>
    if ($("#{{$id}}").length > 0){
        CKEDITOR.replace( '{{$name}}',
         {
             language: 'en',
             @if($dir == 'ar')
             contentsLangDirection: 'rtl',
             @endif
             height: {{$height}},
             @if($uploadPhoto)
             filebrowserUploadUrl: "{{route('admin.fileBrowser.CkeditorUpload',['_token'=>csrf_token()])}}",
             @endif
             removePlugins : 'print,save,newpage,flash,another,form',
             toolbarGroups : [
                 { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
                 { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                 // { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
                 { name: 'insert', groups: [ 'insert' ] },
                 { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                 { name: 'links', groups: [ 'links' ] },
                 { name: 'colors', groups: [ 'colors' ] },
                 { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
                 { name: 'styles', groups: [ 'styles' ] },
                 { name: 'tools', groups: [ 'tools' ] },
             ],
             @if($filebrowser)
             extraPlugins : 'filebrowser',
             filebrowserBrowseUrl: '{{route('admin.filebrowser.index')}}',
             filebrowserImageBrowseUrl: '{{route('admin.filebrowser.index')}}',
             @endif
         }
        );
        CKEDITOR.config.removeButtons = 'Save,NewPage,ExportPdf,Preview,Print,Templates,About,Smiley,SpecialChar,PageBreak,Iframe,Language,BidiRtl,BidiLtr,Subscript,Superscript,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Find,Replace,SelectAll,Scayt';
    }
</script>