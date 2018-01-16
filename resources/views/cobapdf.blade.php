<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>View File</title>
    <link rel="stylesheet" href="">
</head>
<body>

<!--<ol>-->
<!--    <li>Assignment<a href="web/viewer.html?file=assignment" title=""> open</a></li>-->
<!--    <li>How vocabulary should be learned<a href="web/viewer.html?file=How-vocabulary-should-be-learned.pdf" title=""> open</a></li>-->
<!--    <li>Sustainable Tourism Development case study Ochheuteal Beach<a href="web/viewer.html?file=Sustainable Tourism Development case study Ochheuteal Beach" title=""> open</a></li>-->
<!--    <li>Coba 1<a href="web/viewer.html?file=Laporan_PDB_KAWE_old.pdf" title=""> open</a></li>-->
<!--</ol>-->
<!---->

@if(isset($url))
<a href="viewer-pdf/viewer.html?{{ URL::asset($url) }}">
    klik
</a>
@endif

<form method="POST" action="{{ url(action('UserController@storepdf')) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="file" name="files" id="myfiles" value="" accept=".pdf"><br>
    <textarea type="text" id="base64" name="encoded" cols="50" hidden></textarea>
    <button type="submit">submit</button>
</form>

<script>
    document.getElementById('myfiles').addEventListener('change', function(event){

        var input = document.getElementById("myfiles");

        var fReader = new FileReader();
        fReader.readAsDataURL(input.files[0]);
        fReader.onloadend = function(event){
            document.getElementById("base64").innerHTML = event.target.result;
            console.log(event.target.result);

        }
    });
</script>

</body>
</html>
