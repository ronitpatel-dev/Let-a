const logo = document.getElementById("logo");
const dropdown = document.getElementById("dropdownMenu");

logo.addEventListener("click", () => {
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
});

// Optional: Hide dropdown on outside click
document.addEventListener("click", (e) => {
    if (!logo.contains(e.target)) {
        dropdown.style.display = "none";
    }
});
document.addEventListener("DOMContentLoaded", () => {
    const contentDiv = document.getElementById("content");


    //==================================================================================

    const loadInner = (className) => {
        fetch("subt.html")
            .then((res) => res.text())
            .then((htmlText) => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(htmlText, "text/html");
                const innerContent = doc.querySelector(`.${className}`);
                if (innerContent) {
                    contentDiv.innerHTML = innerContent.outerHTML;
                } else {
                    contentDiv.innerHTML = "<p>Content not found.</p>";
                }
            })
            .catch((error) => {
                console.error("Error loading content:", error);
                contentDiv.innerHTML = "<p>Error loading content.</p>";
            });
    };

    document.getElementById("msc-it").addEventListener("click", () => loadInner("inner1"));
    document.getElementById("html-course").addEventListener("click", () => loadInner("inner2"));
    document.getElementById("css-course").addEventListener("click", () => loadInner("inner3"));
    document.getElementById("js-course").addEventListener("click", () => loadInner("inner4"));
    document.getElementById("python-course").addEventListener("click", () => loadInner("inner5"));
});

//==========================================================
