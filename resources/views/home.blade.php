@extends('layout.layout')

@section('title', 'Página de inicio')

@section('content')
    <br />
    <br />



    <div class="imagen-con-texto">
        <img src="images/portada.jpg" class="card-img-top p-2" alt="..." loading="lazy">
        <div class="texto">
            <h2>Oposiciones a Técnico Auxiliar de Informática</h2>
            <p>Personaliza tu preparación. Podrás hacer test por temas y materias sin límites. ¡Haz los test que quieras,
                cuando quieras!</p>
        </div>
    </div>
    <div class="container text-center col-lg-10 py-3 mb-3">
    
        <div class="row justify-content-center py-4">
    
            <div class="col-md-4 mb-4">
                <div class="card cards-container">
                    <img src="images/portada1.jpg" class="card-img-top p-2" alt="..." loading="lazy">
                    <div class="card-body">
                        <h5 class="card-title">Fácil y cómodo de seguir</h5>
                        <p class="card-text">
                            Accesible desde cualquier dispositivo y con una interfaz intuitiva. ¡Regístrate ahora y alcanza el éxito en tu examen de oposición!
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card cards-container">
                    <img src="images/portada2.jpg" class="card-img-top p-2" alt="..." loading="lazy">
                    <div class="card-body">
                        <h5 class="card-title">Temario actualizado</h5>
                        <p class="card-text">
                            Preguntas actualizadas al temario de la última convocatoria de 2022 y anteriores en nuestra plataforma en línea. ¡Regístrate ahora y obtén una preparación efectiva!
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card cards-container">
                    <img src="images/portada3.jpeg" class="card-img-top p-2" alt="..." loading="lazy">
                    <div class="card-body">
                        <h5 class="card-title">Más de 1000 preguntas</h5>
                        <p class="card-text">
                            Regístrate ahora para acceder a más de 1000 preguntas diseñadas por expertos. ¡Obtén una preparación efectiva y alcanza el éxito en tu examen de oposición!
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />

        <div class="card col-lg-10 py-4 mx-auto mt-4">
            <div class="card-title">
                <h5>Contenido del temario</h5>
            </div>
            <div class="card-body">
                El temario se dividirá en 36 temas estructurados en cuatro bloques. El primero de ellos se centra en materias legislativas y jurídicas, y los tres restantes versan sobre contenido informático.
            </div>
        </div>
       
    </body>
    </html>

@endsection
