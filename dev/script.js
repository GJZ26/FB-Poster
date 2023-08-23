const reactions = [
    "haha",
    "wow",
    "angry",
    "sad",
    "love",
    "like",
    "care"
]

const randomTitles = [
    "Científicos descubren nueva especie de planta luminiscente en el Amazonas",
    "Robot doméstico establece récord mundial en resolver cubos de Rubik",
    "Astronautas encuentran evidencia de vida extraterrestre en una luna de Júpiter",
    "Startup promete entregar paquetes utilizando unicornios entrenados",
    "Investigadores crean dispositivo que convierte sueños en obras de arte digitales",
    "Ciudad flotante autosostenible será construida en medio del océano Pacífico",
    "Perro callejero adoptado por estación de bomberos salva a gato atrapado en un árbol",
    "Nueva app permite a las plantas comunicarse sus necesidades a los dueños",
    "Arqueólogos afirman haber encontrado la espada del Rey Arturo en una cueva secreta",
    "Estudiante de 12 años obtiene un doctorado en física nuclear",
    "Restaurante lanza el primer menú diseñado completamente por inteligencia artificial",
    "Empresa ofrece viajes turísticos a Marte a precio de oferta",
    "Se descubre antigua ciudad submarina debajo de un popular destino de buceo",
    "Escultura robótica gigante cobra vida durante una exhibición en un museo",
    "Nuevo dispositivo permite a los humanos entender y hablar el lenguaje de los delfines"
];

const randomResumes = [
    "Un equipo de científicos ha anunciado el descubrimiento de una planta sorprendente que emite luz en plena oscuridad en la selva amazónica...",
    "En un evento que dejó a todos boquiabiertos, un robot diseñado para tareas domésticas resolvió un cubo de Rubik en un tiempo récord...",
    "La misión espacial a una de las lunas de Júpiter ha revelado evidencia de posibles formas de vida microscópicas, lo que plantea emocionantes preguntas sobre la vida más allá de la Tierra...",
    "Una startup ha anunciado planes para revolucionar la entrega de paquetes mediante el uso de unicornios entrenados que transportarán mercancías a través de áreas de difícil acceso...",
    "Investigadores han desarrollado un dispositivo innovador capaz de transformar los sueños de las personas en impresionantes obras de arte digital, lo que plantea nuevas posibilidades creativas...",
    "Una audaz iniciativa busca construir una ciudad flotante autosostenible en medio del océano Pacífico, utilizando tecnologías innovadoras para abordar los desafíos ambientales...",
    "La heroica historia de un perro callejero que se convirtió en héroe local después de rescatar a un gato atrapado en un árbol ha conmovido a la comunidad...",
    "Una nueva aplicación de jardinería permite a las plantas comunicar sus necesidades y emociones a los dueños a través de un sistema de notificaciones...",
    "Arqueólogos afirman haber hecho un descubrimiento extraordinario al encontrar una espada antigua en una cueva secreta, que creen que podría estar vinculada a la leyenda del Rey Arturo...",
    "Un prodigio adolescente ha dejado al mundo atónito al obtener un doctorado en física nuclear a la edad de 12 años, desafiando todas las expectativas...",
    "En un giro sorprendente, un restaurante de alta cocina ha lanzado un menú diseñado completamente por inteligencia artificial, desafiando las normas culinarias convencionales...",
    "La carrera por llevar humanos a Marte da un paso audaz con una empresa que ofrece viajes turísticos al Planeta Rojo a un precio que sorprende a muchos...",
    "Buzos explorando un popular sitio de buceo han hecho un descubrimiento asombroso: una antigua ciudad sumergida yace en las profundidades, revelando secretos de civilizaciones pasadas...",
    "Una escultura robótica en una exhibición de arte ha dejado al público atónito al cobrar vida y comenzar a interactuar con los espectadores de manera inesperada...",
    "La barrera de la comunicación entre humanos y delfines finalmente ha sido rota gracias a un dispositivo innovador que permite a los humanos entender y hablar el lenguaje de estos mamíferos marinos..."
];

const ogimageuri = [
    "https://www.nationalgeographic.com.es/medio/2022/09/21/hongo-bioluminiscente_a8555106_960x619.jpg",
    "https://s1.eestatic.com/2023/05/13/omicrono/analisis-prueba-productos/763433668_233129392_1706x960.jpg",
    "https://cnnespanol.cnn.com/wp-content/uploads/2015/08/jice-jupiter.jpg?quality=100&strip=info",
    "https://i.etsystatic.com/9357497/r/il/bf221e/617588189/il_1080xN.617588189_o4qs.jpg",
    "https://cdn.computerhoy.com/sites/navi.axelspringer.es/public/media/image/2018/03/293503-suenos-lucidos.jpg?tf=3840x",
    "https://conocedores.com/wp-content/uploads/2022/08/downtown-circle-dubai-ciudad-flotante-floating-24072022in5.webp",
    "https://static.nationalgeographic.es/files/styles/image_3200/public/01-stray-dogs-nationalgeographic_1927666.jpg?w=1600&h=900",
    "https://lamanzanamordida.net/app/uploads-lamanzanamordida.net/2021/06/Apps-para-cuidar-plantas.jpg",
    "https://vacacionestodoincluido.net/wp-content/uploads/2017/03/espada-en-la-roca-excalibur-san-galgano.jpg",
    "https://mymodernmet.com/wp/wp-content/uploads/2022/04/elliott-tanner-physics.jpg",
    "https://laroussecocina.mx/wp-content/uploads/2023/02/AICocina_portada.jpg",
    "https://upload.wikimedia.org/wikipedia/commons/f/f1/Mars_mission.jpg",
    "https://s3.amazonaws.com/arc-wordpress-client-uploads/infobae-wp/wp-content/uploads/2016/12/27172814/dwarka2-1024x668.jpg",
    "https://1.bp.blogspot.com/--1uCtixtUpQ/T1eWn9ewV5I/AAAAAAAAaS0/3dtwi1glPrM/s1600/esculturas-robots_con_desechos_transformers16.jpg",
    "https://cdn.vallarta-adventures.com/sites/default/files/inline-images/BLOG_dolphin_ext_0.jpg",

]

const extrPrevie = document.getElementById("extrapreview")
const longURI = document.getElementById("useLongURIFb");
const uriFb = document.getElementById("urifb")
const titFb = document.getElementById("titlefb")
const urFbOG = document.getElementById("resumefb")
const omgImgCont = document.getElementById("ogimgcontent")
const delayAl = document.getElementById("delay")
const reactionsFaces = document.getElementsByClassName("reactionface")
const mrInfoContainer = document.getElementById("moreinfocontainerFB")
const descriptionFB = document.getElementById("addDescriptionFB");
const upperTitleFB = document.getElementById("upperTitleFB");
const tokenFB = document.getElementById("tokenfb")

function randomIntFromInterval(min, max) { // min and max included 
    return Math.floor(Math.random() * (max - min + 1) + min)
}

extrPrevie.textContent = document.getElementById("extra").value

let randomIndex = randomIntFromInterval(0, randomTitles.length - 1)
let randomTitle = randomTitles[randomIndex];

document.getElementById("commentsfb").textContent = `${randomIntFromInterval(2, 100)} comentarios`
document.getElementById("sharedfb").textContent = `${randomIntFromInterval(2, 100)} veces compartido`
document.getElementById("reacount").textContent = `${randomIntFromInterval(3, 100)}`
uriFb.textContent = `${window.location.origin}/${longURI.checked ? randomTitles[randomIndex]
    .trim()
    .toLowerCase()
    .replace(/\s/g, "-") :
    `?p=${randomIndex}`}`

document.getElementById("uriog").textContent = window.location.hostname

document.getElementById("extra").addEventListener('input', (event) => {
    extrPrevie.textContent = event.target.value
})

titFb.textContent = randomTitle.toUpperCase();
urFbOG.textContent = randomResumes[randomIndex];
document.getElementById("ogtitle").textContent = randomTitle;
document.getElementById("ogcont").textContent = randomResumes[randomIndex];


delayAl.addEventListener('input', (event) => {
    let minutes = event.target.value;
    let hours = 0
    let days = 0
    while (minutes >= 60) {
        hours = Math.floor(minutes / 60);
        while (hours >= 24) {
            days = Math.floor(hours / 23)
            hours = hours % 24
        }
        minutes = minutes % 60
    }

    let message = days > 0 ? `${days} días ` : ``
    message += hours > 0 ? `${hours} horas ` : ``;

    message += minutes > 0 && message != "" ? `${minutes} minutos.` : ``;

    if (event.target.value > 108000 || event.target.value < 10) {
        message = "Valor inválido..."
        // delayAl.select()
    }
    document.getElementById("bettertime").textContent = message !== "" ? `(${message})` : ""
})

const reactLength = reactionsFaces.length;
let done = []

for (let i = 0; i < reactLength; i++) {
    let currentReact = randomIntFromInterval(0, reactions.length - 1)

    while (done.includes(currentReact)) {
        currentReact = randomIntFromInterval(0, reactions.length - 1)
    }
    done.push(currentReact)

    reactionsFaces[i].classList.add(reactions[currentReact])
}

if (descriptionFB.checked) urFbOG.textContent = randomResumes[randomIndex];
else urFbOG.textContent = '';

descriptionFB.addEventListener("change", (event) => {
    if (event.target.checked) urFbOG.textContent = randomResumes[randomIndex];
    else urFbOG.textContent = '';
})

if (upperTitleFB.checked) titFb.textContent = randomTitle.toUpperCase();
else titFb.textContent = randomTitle;

upperTitleFB.addEventListener("change", (event) => {
    if (event.target.checked) titFb.textContent = randomTitle.toUpperCase();
    else titFb.textContent = randomTitle;
})

document.getElementById("uptoken").addEventListener('click', (event) => {
    event.preventDefault()
    tokenFB.value = ''
    tokenFB.disabled = false;
    tokenFB.focus()
    document.getElementById("uptoken").remove();
    document.getElementById("tknstatus").remove();
})

if (tokenFB.value === '') {
    document.getElementById("uptoken").remove();
    document.getElementById("tknstatus").remove();
}

uriFb.textContent = `${window.location.origin}/${longURI.checked ? randomTitles[randomIndex]
    .trim()
    .toLowerCase()
    .replace(/\s/g, "-") :
    `?p=${randomIndex}`}`

longURI.addEventListener("change", () => {
    uriFb.textContent = `${window.location.origin}/${longURI.checked ? randomTitles[randomIndex]
        .trim()
        .toLowerCase()
        .replace(/\s/g, "-") :
        `?p=${randomIndex}`}`
})

omgImgCont.style.background = `url("${ogimageuri[randomIndex]}")`
omgImgCont.style.backgroundPosition = "center"
omgImgCont.style.backgroundSize = "cover"
omgImgCont.style.backgroundRepeat = "no-repeat"
omgImgCont.style.backgroundColor = "rgb(222, 222, 222)"

document.getElementById("showMoreInfoFB").addEventListener("click", () => {
    mrInfoContainer.style.display = "block"
})

document.getElementById("closemoreinfocontainer").addEventListener("click", () => {
    mrInfoContainer.style.display = "none"
})