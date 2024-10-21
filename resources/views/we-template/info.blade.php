<div>
    <div class="form-group">
        <label for="templete">Template</label>
        <textarea class="form-control" cols="30" rows="7">{{ $template->template }}</textarea>
    </div>
    @if ($params > 0)
        <div class="form-group">
            <label for="template">Param ( seperate by comma )</label>
            <input type="text" class="form-control" name="params" placeholder="param1,param2..." />
        </div>
        {{-- @for ($i = 0; $i < $params; $i++)
        @endfor --}}
    @endif
</div>
