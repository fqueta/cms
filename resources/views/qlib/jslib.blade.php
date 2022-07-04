@include('qlib.partes_html',['config'=>[
    'parte'=>'modal',
    'id'=>'modal-geral',
    'conteudo'=>false,
    'botao'=>false,
    'botao_fechar'=>true,
    'tam'=>'modal-lg',
]])
<script src="{{url('/')}}/js/jquery.maskMoney.min.js"></script>
<script src="{{url('/')}}/js/jquery.validate.min.js"></script>
<script src="{{url('/')}}/js/jquery-ui.min.js"></script>
<script src="{{url('/')}}/js/jquery.inputmask.bundle.min.js"></script>
<script src="{{url('/')}}/summernote/summernote.min.js"></script>
<script src=" {{url('/')}}/js/lib.js"></script>
<script>
    $(function(){
        $('.dataTable').DataTable({
                "paging":   false,
                stateSave: true,
                language: {
                    url: '/DataTables/datatable-pt-br.json'
                }
        });
        carregaMascaraMoeda(".moeda");
        $('[selector-event]').on('change',function(){
            initSelector($(this));
        });
        $('[vinculo-event]').on('click',function(){
            var funCall = function(res){};
            initSelector($(this));
        });

        $('.select2').select2();
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
        var urlAuto = $('.autocomplete').attr('url');
        $( ".autocomplete" ).autocomplete({
            source: urlAuto,
            select: function (event, ui) {
                //var sec = $(this).attr('sec');
                lib_listarCadastro(ui.item,$(this));
            },
        });
        $('.summernote').summernote({
            height: 400,
            placeholder: 'Digite o conteudo',
        });
        $('[type_slug="true"]').on('keyup',function(e){
            let text = lib_urlAmigavel($(this).val());
            $(this).val(text);
        });
    });
</script>
@if (App\Qlib\Qlib::qoption('editor_padrao')=='tinymce')
    @php
        $BASE = '/';
    @endphp
    <script>
        var BASE = '{{$BASE}}';
    </script>
    <script src="{{$BASE}}vendor/tinymce/tinymce.min.js"></script>
    <script>
        $(function(){
            tinymce.init({
                selector: ".editor-padrao",theme: "modern",height: 600,
                language: 'pt_BR',
                setup: function (editor) {
                    editor.on('change', function () {
                        editor.save();
                    });
                },
                relative_urls: false,
                remove_script_host : false,
                plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                        "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
                ],
                toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
                toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
                image_advtab: true ,

                external_filemanager_path:"/vendor/filemanager/",
                filemanager_title:"Responsive Filemanager" ,
                external_plugins: { "filemanager" : "/vendor/filemanager/plugin.min.js"}
            });
        });
    </script>
@endif
