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
function showCourse() {
    document.getElementById("inner-Content-1").innerHTML = `
        <h3>🔹 1. MS Word – Word Processing</h3><br>
        1. Introduction to Word interface.<br>
        2. Creating and saving documents.<br>
        3. Formatting text and paragraphs.<br>
        4. Inserting tables, images, and shapes.<br>
        5. Page layout and printing options.<br>
        6. Using headers, footers, and page numbers.<br>
        7. Mail Merge (basic)<br><br>

        <h3>🔹 2. MS Excel – Spreadsheets</h3><br>
        1. Introduction to Excel interface.<br>
        2. Working with cells, rows, and columns.<br>
        3. Basic formulas and functions (SUM, AVERAGE, etc.).<br>
        4. Formatting cells and data types.<br>
        5. Sorting and filtering data.<br>
        6. Creating charts and graphs.<br>
        7. Introduction to Pivot Tables<br><br>

        <h3> 🔹 3. MS PowerPoint – Presentations</h3><br>
        1. Introduction to PowerPoint interface.<br>
        2. Creating and organizing slides.<br>
        3. Applying themes and slide layouts.<br>
        4. Adding text, images, and videos.<br>
        5. Using transitions and animations.<br>
        6. Slide show and presentation tips.<br>
        7. Printing and exporting slides.<br>
    `;
}

function showNotes() {
    document.getElementById("inner-Content-1").innerHTML = `
        <h3>Select a Note</h3>
        <ul class="notes-list">
            <li><button onclick="loadPDF('notes1.pdf')">Notes 1</button></li>
            <li><button onclick="loadPDF('notes2.pdf')">Notes 2</button></li>
            <li><button onclick="loadPDF('notes3.pdf')">Notes 3</button></li>
            <li><button onclick="loadPDF('notes4.pdf')">Notes 4</button></li>
            <li><button onclick="loadPDF('notes5.pdf')">Notes 5</button></li>
        </ul>
    `;
}

function loadPDF(fileName) {
    document.getElementById("inner-Content-1").innerHTML = `
        <iframe src="pdfs/${fileName}" width="100%" height="500px"></iframe>
        <br>
        <a href="pdfs/${fileName}" download>
            <button>Download PDF</button>
        </a>
    `;
}
