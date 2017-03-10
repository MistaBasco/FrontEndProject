(function () {
    let partialsCache = {};

    function fetchFile(path, callback) {
        let request = new XMLHttpRequest();

        request.onload = function () {
            callback(request.responseText);
        };

        request.open("GET", path);
        request.send(null);
    }

    function getContent(fragmentId, callback) {
        if (partialsCache[fragmentId]) {
            callback(partialsCache[fragmentId]);
        }
        else {
            fetchFile("partials/" + fragmentId + ".php", function (content) {
                partialsCache[fragmentId] = content;
                callback(content);
            });
        }

        fetchFile("partials/" + fragmentId + ".php", callback);
    }

    function setActiveLink(fragmentId) {
        let links = document.querySelectorAll("ul#navbar li a"),
            // let navbarDiv = document.getElementById("navigation"),
            //    links = navbarDiv.children,
            i, link, pageName;

        for (i = 0; i < links.length; i++) {
            link = links[i];

            pageName = link.getAttribute("href").substr(1);

            if (pageName === fragmentId) {
                link.setAttribute("class", "active");
            }
            else {
                link.removeAttribute("class");
            }
        }
    }

//Updates dynamic content based on fragment identifier
    function navigate() {
        //get a reference to element with id "content"
        let contentDiv = document.getElementById('content');

        let fragmentId = location.hash.substr(1);
        if (fragmentId === "follow") {

        }
        else {
            getContent(fragmentId, function (content) {
                contentDiv.innerHTML = content;
            });
        }

        setActiveLink(fragmentId);
    }

    if (!location.hash) {
        location.hash = "#home";
    }
    navigate();

    window.addEventListener("hashchange", navigate);

}());