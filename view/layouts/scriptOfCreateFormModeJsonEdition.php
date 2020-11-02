
<script type="text/javascript">
    const container = document.getElementById("jsoneditor")
    const options = {}
    const editor = new JSONEditor(container, options)
    var variableRecuperee = <?php echo stripslashes(json_encode($doc)); ?>;
    var link_doc = <?php echo (json_encode($link_doc)); ?>;
    var date_array = <?php echo json_encode(serialize($date_array)); ?>;
    var up_date_array = <?php echo json_encode(serialize($up_date_array)); ?>;

    /* Création du formulaire */

    const initialJson = variableRecuperee;
    editor.set(initialJson);
    editor.expandAll();

    /* Fonction d'envoi du formulaire */

    document.getElementById('getJSON').onclick = function () {
        getJson();

    }
    document.getElementById('getJSON2').onclick = function () {
        getJson();

    }

    function getJson(){
        const json = editor.get()
        var updatedJson = JSON.stringify(json, null, 2)

        var f = document.createElement("form");
        f.setAttribute('method',"post");
        f.setAttribute('action',link_doc);
        f.setAttribute('id',"idFormulaire");

        var i = document.createElement("input"); //input element, text
        i.setAttribute('type',"hidden");
        i.setAttribute('name',"doc_text");
        i.setAttribute('value',updatedJson);

        var j = document.createElement("input"); //input element, text
        j.setAttribute('type',"hidden");
        j.setAttribute('name',"date_array");
        j.setAttribute('value',date_array);

        var k = document.createElement("input"); //input element, text
        k.setAttribute('type',"hidden");
        k.setAttribute('name',"up_date_array");
        k.setAttribute('value',up_date_array);

        f.appendChild(i);
        f.appendChild(j);
        f.appendChild(k);

        var span = document.getElementById("nC");

        span.appendChild(f);

        document.getElementById("idFormulaire").submit();
    }
</script>