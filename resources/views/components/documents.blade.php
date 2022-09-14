<div class="row justify-content-start">

    @for ($i = 1; $i < 19; $i++)
        <x-document name="doc_test.txt" version="{{ $i }}" link="http://asd.hu" id="{{ $i }}" />
    @endfor

</div>
