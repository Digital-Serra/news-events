<div class="form-group">
    {!! Form::label('title','Título:',['class'=>'col-sm-2 control-label']) !!}

    <div class="col-sm-10">
        {!! Form::text('title',null,['placeholder'=>'Título da notícia ou evento','class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('body','Descrição da notícia:',['class'=>'col-sm-2 control-label']) !!}

    <div class="col-sm-10">
        {!! Form::textarea('body',null,['id'=>'textarea_ck','placeholder'=>'Escreva aqui a descrição e detalhes do produto','class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('published','Publicar?',['class'=>'col-sm-2 control-label']) !!}

    <div class="col-sm-10">
        {!! Form::radio('published', 0, false) !!} Não <br>
        {!! Form::radio('published', 1, false) !!} Sim
    </div>
</div>
<div class="form-group">
    {!! Form::label('tags','Tags para a notícia (opcional)',['class'=>'col-sm-2 control-label']) !!}

    <div class="col-sm-10">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-tags"></i></span>
            {!! Form::text('tags',null,['placeholder'=>'tag1,tag2,tag3','class'=>'form-control']) !!}
        </div>
    </div>
</div>
<div class="form-group">
    @if(isset($edit_news) && $edit_news != null)
        @if($images != [])
            {!! Form::label('currentImages[]','Editar imagens',['class'=>'col-sm-2 control-label']) !!}

            <div class="col-sm-10">
                <div class="row">
                    Marque as imagens que deseja excluir: <br>
                    @foreach($images as $image)
                        {!! Form::checkbox('currentImages[]', $image, false) !!}
                        <img src="{{asset($image)}}" alt="" class="" width="100" height="100"> <br><br>
                    @endforeach
                </div>
            </div>
        @endif
</div>
    @endif
<div class="form-group">
    {!! Form::label('images','Adicionar imagem',['class'=>'col-sm-2 control-label']) !!}

    <div class="col-sm-10">
        {!! Form::file('images[]',['class'=>'form-control','multiple'=>'true']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
        <button type="submit" class="btn btn-blue btn-effect text-light-blue"><i
                    class="fa fa-paper-plane-o"></i> Enviar
        </button>
    </div>
</div>