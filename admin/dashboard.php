<?php

if (!defined('ABSPATH') || !function_exists('add_action')) {
    echo "Bro, you are really curious...";
    exit;
}

$infoMan = new InfoManager();
$FbReq = new FbRequester();

function transform_string($input_string)
{
    if ($input_string == "") return "";

    $length = strlen($input_string);

    if ($length <= 8) {
        return " • • • • •";
    }

    $first_part = substr($input_string, 0, 4);
    $last_part = substr($input_string, -4);
    $middle_part = str_repeat(' • ', 6);

    return $first_part . $middle_part . $last_part;
}


$result = $infoMan->getCredentials();

$result = $infoMan->check_update($result, $_POST);
$dataApp = $FbReq->getAppInfo($result);

$infoMan->updateAppIDIntoDB($dataApp);

?>


<div class="wrap">
    <h1 class="titlefbplugin">FB Poster - Configuraciones</h1>
    <form method="post" class="coolFBForm">
        <div>
            <label for="tokenfb">Token</label>
            <input value="<?php echo transform_string($result["token"]) ?>" <?php if ($result["token"] !== "") {
                                                                                echo "disabled";
                                                                            } ?> type="text" name="tokenfb" id="tokenfb">
            <span class="token-status <?php echo isset($dataApp["error"]) || empty($dataApp) ? "tkninvalid" : "tknvalid" ?>" id="tknstatus"><?php echo isset($dataApp["error"]) || empty($dataApp) ? "Token Inválido" : "Activo" ?></span>
            <button id="uptoken">Actualizar</button>
        </div>

        <div>
            <label for="delay">Demora (minutos)</label>
            <input required type="number" value="<?php echo $result["delay"] ?>" name="delay" id="delay" min="10" max="108000"> minutos&nbsp;<span id="bettertime"></span>
        </div>

        <div>
            <label for="extra">Mensaje Extra</label>
            <input value="<?php echo $result["extra"] ?>" type="text" name="extra" id="extra">
        </div>

        <div>
            <label for="addDescriptionFB">Añadir descripcion</label>
            <input <?php if ($result["add_description"] == "1") echo "checked"; ?> type="checkbox" name="addDescriptionFB" id="addDescriptionFB">
        </div>
        <div>
            <label for="upperTitleFB">Título en mayúsculas</label>
            <input <?php if ($result["upper"] == "1") echo "checked"; ?> type="checkbox" name="upperTitleFB" id="upperTitleFB">
        </div>

        <div>
            <label for="useLongURIFb">Usar URL larga</label>
            <input <?php if ($result["long_uri"] == "1") echo "checked"; ?> type="checkbox" name="useLongURIFb" id="useLongURIFb">
        </div>

        <input type="submit" value="Guardar" id="savefbsetting">
    </form>
    <div class="fbpreview">
        <div class="fbheader">
            <div class="image">
                <div class="image-content" style="background-image: 
                url(<?php echo isset($dataApp["picture"]["data"]["url"]) ?
                        $dataApp["picture"]["data"]["url"] :
                        "https://media.tenor.com/3HwPQSKmmvQAAAAC/peepo-sad.gif"
                    ?>);background-position: center;background-size: cover;"></div>
            </div>
            <div class="user-info">
                <span class="page-title">
                    <?php echo isset($dataApp["name"]) ? $dataApp["name"] : "A page that doesn't load"  ?>
                </span>
                <span class="date">
                    Publicado por <span id="bot-name">Bot</span> <span class="time">15h <em>- Preview</em></span>
                </span>
            </div>
        </div>
        <div id="fbfmb" class="fb-content">
            <span id="titlefb">Si estás leyendo este texto, ha ocurrido un error con tu plugin</span>
            <span id="resumefb">Por favor, desactívelo y contacte al equipo de soporte</span>
            <span id="extrapreview">Lamentamos el incoveniente...</span>
            <span class="urifb" id="urifb"> -- </span>
        </div>
        <div class="fb-embed">
            <div class="ogimg">
                <div class="ogimgcontent" id="ogimgcontent">
                </div>
            </div>
            <div class="ogdesc">
                <div class="uriog" id="uriog"> -- </div>
                <div class="ogtitle" id="ogtitle"> -- </div>
                <div class="ogcont" id="ogcont"> -- </div>
            </div>
        </div>
        <div class="fbreact">
            <div class="yop">
                <div class="reactions">
                    <span class="reactionface"></span>
                    <span class="reactionface"></span>
                    <span class="reactionface"></span>
                </div>
                <span id="reacount"> -- </span>
            </div>
            <div class="shared">
                <span id="commentsfb"> -- </span>
                <span id="sharedfb"> -- </span>
            </div>
        </div>
    </div>
    <a id="showMoreInfoFB">
        Más información
    </a>
    <div class="moreinfofb" id="moreinfocontainerFB" style="display: none;">
        <h1>Condiciones</h1>
        <p>
            El complemento ha sido desarrollado para satisfacer las necesidades técnicas de una entidad, y no ostenta propiedad por parte de dicha empresa. El código fuente correspondiente a este complemento se encuentra disponible a través del enlace proporcionado, y está regido por la licencia <strong>GNU General Public License v3.0 </strong>.
        </p>
        <h1>Vista previa e imágenes</h1>
        <p>
            La información utilizada para la vista previa de las publicaciones ha sido generada por el modelo <strong>GPT 3.5</strong>, propiedad de <strong><em>Open AI</em></strong>, y se deriva de una selección de posibles contenidos previamente generados.
        </p>
        <p>
            Es fundamental tener en cuenta que las reacciones, comentarios y compartidos no aseguran resultados idénticos en la etapa final. En su lugar, estas interacciones se exhiben únicamente con la intención de proporcionar ilustraciones.
        </p>
        <p>
            Los enlaces correspondientes a estas vistas previas están desactivados y no deben considerarse como entradas de publicación reales. Todos los datos almacenados residen en los scripts ejecutados en el navegador y no tienen impacto en la base de datos de las entradas existentes.
        </p>
        <p>

            Las imágenes que se muestran han sido seleccionadas para ilustrar el contenido generado y no son de propiedad del desarrollador. Es importante tener en cuenta que estas imágenes pueden ser eliminadas del programa si así se requiere, sin previo aviso.
        </p>
        <ul>
            <li>https://www.nationalgeographic.com.es/medio/2022/09/21/hongo-bioluminiscente_a8555106_960x619.jpg</li>
            <li>https://s1.eestatic.com/2023/05/13/omicrono/analisis-prueba-productos/763433668_233129392_1706x960.jpg</li>
            <li>https://cnnespanol.cnn.com/wp-content/uploads/2015/08/jice-jupiter.jpg?quality=100&strip=info</li>
            <li>https://i.etsystatic.com/9357497/r/il/bf221e/617588189/il_1080xN.617588189_o4qs.jpg</li>
            <li>https://cdn.computerhoy.com/sites/navi.axelspringer.es/public/media/image/2018/03/293503-suenos-lucidos.jpg?tf=3840x</li>
            <li>https://conocedores.com/wp-content/uploads/2022/08/downtown-circle-dubai-ciudad-flotante-floating-24072022in5.webp</li>
            <li>https://static.nationalgeographic.es/files/styles/image_3200/public/01-stray-dogs-nationalgeographic_1927666.jpg?w=1600&h=900</li>
            <li>https://lamanzanamordida.net/app/uploads-lamanzanamordida.net/2021/06/Apps-para-cuidar-plantas.jpg</li>
            <li>https://vacacionestodoincluido.net/wp-content/uploads/2017/03/espada-en-la-roca-excalibur-san-galgano.jpg</li>
            <li>https://mymodernmet.com/wp/wp-content/uploads/2022/04/elliott-tanner-physics.jpg</li>
            <li>https://laroussecocina.mx/wp-content/uploads/2023/02/AICocina_portada.jpg</li>
            <li>https://upload.wikimedia.org/wikipedia/commons/f/f1/Mars_mission.jpg</li>
            <li>https://s3.amazonaws.com/arc-wordpress-client-uploads/infobae-wp/wp-content/uploads/2016/12/27172814/dwarka2-1024x668.jpg</li>
            <li>https://1.bp.blogspot.com/--1uCtixtUpQ/T1eWn9ewV5I/AAAAAAAAaS0/3dtwi1glPrM/s1600/esculturas-robots_con_desechos_transformers16.jpg</li>
            <li>https://cdn.vallarta-adventures.com/sites/default/files/inline-images/BLOG_dolphin_ext_0.jpg</li>
        </ul>
        <a id="closemoreinfocontainer">Cerrar</a>
        <p></p>
    </div>
</div>
<script>var e="haha wow angry sad love like care".split(" "),a="Científicos descubren nueva especie de planta luminiscente en el Amazonas;Robot doméstico establece récord mundial en resolver cubos de Rubik;Astronautas encuentran evidencia de vida extraterrestre en una luna de Júpiter;Startup promete entregar paquetes utilizando unicornios entrenados;Investigadores crean dispositivo que convierte sueños en obras de arte digitales;Ciudad flotante autosostenible será construida en medio del océano Pacífico;Perro callejero adoptado por estación de bomberos salva a gato atrapado en un árbol;Nueva app permite a las plantas comunicarse sus necesidades a los dueños;Arqueólogos afirman haber encontrado la espada del Rey Arturo en una cueva secreta;Estudiante de 12 años obtiene un doctorado en física nuclear;Restaurante lanza el primer menú diseñado completamente por inteligencia artificial;Empresa ofrece viajes turísticos a Marte a precio de oferta;Se descubre antigua ciudad submarina debajo de un popular destino de buceo;Escultura robótica gigante cobra vida durante una exhibición en un museo;Nuevo dispositivo permite a los humanos entender y hablar el lenguaje de los delfines".split(";"),t="Un equipo de científicos ha anunciado el descubrimiento de una planta sorprendente que emite luz en plena oscuridad en la selva amazónica...;En un evento que dejó a todos boquiabiertos, un robot diseñado para tareas domésticas resolvió un cubo de Rubik en un tiempo récord...;La misión espacial a una de las lunas de Júpiter ha revelado evidencia de posibles formas de vida microscópicas, lo que plantea emocionantes preguntas sobre la vida más allá de la Tierra...;Una startup ha anunciado planes para revolucionar la entrega de paquetes mediante el uso de unicornios entrenados que transportarán mercancías a través de áreas de difícil acceso...;Investigadores han desarrollado un dispositivo innovador capaz de transformar los sueños de las personas en impresionantes obras de arte digital, lo que plantea nuevas posibilidades creativas...;Una audaz iniciativa busca construir una ciudad flotante autosostenible en medio del océano Pacífico, utilizando tecnologías innovadoras para abordar los desafíos ambientales...;La heroica historia de un perro callejero que se convirtió en héroe local después de rescatar a un gato atrapado en un árbol ha conmovido a la comunidad...;Una nueva aplicación de jardinería permite a las plantas comunicar sus necesidades y emociones a los dueños a través de un sistema de notificaciones...;Arqueólogos afirman haber hecho un descubrimiento extraordinario al encontrar una espada antigua en una cueva secreta, que creen que podría estar vinculada a la leyenda del Rey Arturo...;Un prodigio adolescente ha dejado al mundo atónito al obtener un doctorado en física nuclear a la edad de 12 años, desafiando todas las expectativas...;En un giro sorprendente, un restaurante de alta cocina ha lanzado un menú diseñado completamente por inteligencia artificial, desafiando las normas culinarias convencionales...;La carrera por llevar humanos a Marte da un paso audaz con una empresa que ofrece viajes turísticos al Planeta Rojo a un precio que sorprende a muchos...;Buzos explorando un popular sitio de buceo han hecho un descubrimiento asombroso: una antigua ciudad sumergida yace en las profundidades, revelando secretos de civilizaciones pasadas...;Una escultura robótica en una exhibición de arte ha dejado al público atónito al cobrar vida y comenzar a interactuar con los espectadores de manera inesperada...;La barrera de la comunicación entre humanos y delfines finalmente ha sido rota gracias a un dispositivo innovador que permite a los humanos entender y hablar el lenguaje de estos mamíferos marinos...".split(";"),n=document.getElementById("extrapreview"),o=document.getElementById("useLongURIFb"),i=document.getElementById("urifb"),s=document.getElementById("titlefb"),r=document.getElementById("resumefb"),d=document.getElementById("ogimgcontent"),c=document.getElementById("delay"),l=document.getElementsByClassName("reactionface"),u=document.getElementById("moreinfocontainerFB"),p=document.getElementById("addDescriptionFB"),m=document.getElementById("upperTitleFB"),g=document.getElementById("tokenfb");function v(e,a){return Math.floor(Math.random()*(a-e+1)+e)}n.textContent=document.getElementById("extra").value;var h=v(0,a.length-1),b=a[h];document.getElementById("commentsfb").textContent=v(2,100)+" comentarios",document.getElementById("sharedfb").textContent=v(2,100)+" veces compartido",document.getElementById("reacount").textContent=""+v(3,100),i.textContent=window.location.origin+"/"+(o.checked?a[h].trim().toLowerCase().replace(/\s/g,"-"):"?p="+h),document.getElementById("uriog").textContent=window.location.hostname,document.getElementById("extra").addEventListener("input",(function(e){n.textContent=e.target.value})),s.textContent=b.toUpperCase(),r.textContent=t[h],document.getElementById("ogtitle").textContent=b,document.getElementById("ogcont").textContent=t[h],c.addEventListener("input",(function(e){for(var a=e.target.value,t=0,n=0;60<=a;){for(t=Math.floor(a/60);24<=t;)n=Math.floor(t/23),t%=24;a%=60}t=(0<n?n+" días ":"")+(0<t?t+" horas ":""),t+=0<a&&""!=t?a+" minutos.":"",(108e3<e.target.value||10>e.target.value)&&(t="Valor inválido..."),document.getElementById("bettertime").textContent=""!==t?"("+t+")":""}));for(var f=l.length,y=[],E=0;E<f;E++){for(var w=v(0,e.length-1);y.includes(w);)w=v(0,e.length-1);y.push(w),l[E].classList.add(e[w])}r.textContent=p.checked?t[h]:"",p.addEventListener("change",(function(e){r.textContent=e.target.checked?t[h]:""})),s.textContent=m.checked?b.toUpperCase():b,m.addEventListener("change",(function(e){s.textContent=e.target.checked?b.toUpperCase():b})),document.getElementById("uptoken").addEventListener("click",(function(e){e.preventDefault(),g.value="",g.disabled=!1,g.focus(),document.getElementById("uptoken").remove(),document.getElementById("tknstatus").remove()})),""===g.value&&(document.getElementById("uptoken").remove(),document.getElementById("tknstatus").remove()),i.textContent=window.location.origin+"/"+(o.checked?a[h].trim().toLowerCase().replace(/\s/g,"-"):"?p="+h),o.addEventListener("change",(function(){i.textContent=window.location.origin+"/"+(o.checked?a[h].trim().toLowerCase().replace(/\s/g,"-"):"?p="+h)})),d.style.background='url("'+"https://www.nationalgeographic.com.es/medio/2022/09/21/hongo-bioluminiscente_a8555106_960x619.jpg https://s1.eestatic.com/2023/05/13/omicrono/analisis-prueba-productos/763433668_233129392_1706x960.jpg https://cnnespanol.cnn.com/wp-content/uploads/2015/08/jice-jupiter.jpg?quality=100&strip=info https://i.etsystatic.com/9357497/r/il/bf221e/617588189/il_1080xN.617588189_o4qs.jpg https://cdn.computerhoy.com/sites/navi.axelspringer.es/public/media/image/2018/03/293503-suenos-lucidos.jpg?tf=3840x https://conocedores.com/wp-content/uploads/2022/08/downtown-circle-dubai-ciudad-flotante-floating-24072022in5.webp https://static.nationalgeographic.es/files/styles/image_3200/public/01-stray-dogs-nationalgeographic_1927666.jpg?w=1600&h=900 https://lamanzanamordida.net/app/uploads-lamanzanamordida.net/2021/06/Apps-para-cuidar-plantas.jpg https://vacacionestodoincluido.net/wp-content/uploads/2017/03/espada-en-la-roca-excalibur-san-galgano.jpg https://mymodernmet.com/wp/wp-content/uploads/2022/04/elliott-tanner-physics.jpg https://laroussecocina.mx/wp-content/uploads/2023/02/AICocina_portada.jpg https://upload.wikimedia.org/wikipedia/commons/f/f1/Mars_mission.jpg https://s3.amazonaws.com/arc-wordpress-client-uploads/infobae-wp/wp-content/uploads/2016/12/27172814/dwarka2-1024x668.jpg https://1.bp.blogspot.com/--1uCtixtUpQ/T1eWn9ewV5I/AAAAAAAAaS0/3dtwi1glPrM/s1600/esculturas-robots_con_desechos_transformers16.jpg https://cdn.vallarta-adventures.com/sites/default/files/inline-images/BLOG_dolphin_ext_0.jpg".split(" ")[h]+'")',d.style.backgroundPosition="center",d.style.backgroundSize="cover",d.style.backgroundRepeat="no-repeat",d.style.backgroundColor="rgb(222, 222, 222)",document.getElementById("showMoreInfoFB").addEventListener("click",(function(){u.style.display="block"})),document.getElementById("closemoreinfocontainer").addEventListener("click",(function(){u.style.display="none"}));
</script>