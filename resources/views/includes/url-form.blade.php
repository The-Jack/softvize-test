<div class="card">
    <p>Choose upto 5 Urls to process</p>
    <form class="" method="post" action="/url/submit">
        @csrf
        @for ($i = 1; $i < 6; $i++)
            <div class=form-group>
                <label for="url_{{ $i }}">Url {{ $i }}</label>
                <input type="url" name="url_{{ $i }}" id="url_{{ $i }}" value="" />
            </div>
        @endfor

        <button class="btn">Submit</button>
    </form>
</div>
