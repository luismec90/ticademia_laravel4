@extends('layouts.default')

@section('content')
<h1 class="section-title"><span>Bienvenido</span></h1>
<div class="row">
    <img class="col-sm-5 img-responsive" src="{{ asset('assets/images/general/img_presentacion.png') }}">
    <div id="intro" class="col-sm-7 text-justify">
        <p>Bienvenido(a), TICademia es un espacio para que aprendas de una manera desafiante. Encontrarás cursos de calidad con dos componentes fundamentales. Por una parte están los materiales de estudio, generalmente videos y documentos de apoyo, los cuales son realizados por docentes expertos en las áreas de conocimiento respectivas. Por otra parte están los ejercicios, los cuales no se limitan a simples preguntas de selección estáticas sino que en general están diseñados para medir verdaderamente tu aprendizaje.</p>
        <p>Adicional a esta componente pedagógica, TICademia incluye dentro de sus didácticas un elemento clave: la ludificación. Esto no solo significa que recibirás logros a medida que avanzas e irás escalando niveles, sino también que podrás monitorear en tiempo real que tan “eficiente” eres en el curso, e incluso podrás batirte a duelo (en conocimientos obviamente) con tus compañeros para “arrebatarles” los puntos que te pondrán a la cabeza.</p>
        <p>Por último TICademia también tiene una alta relación con redes sociales, no solo porque cuenta con su propio muro de notificaciones donde podrás compartir tu progreso, así como ver y opinar sobre el de tus compañeros de curso, si no también porque permite la conexión con redes populares como facebook y twitter.</p>
    </div>
</div>
@stop