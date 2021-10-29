import { makePreview } from "./blog.js";
async function loadBlogList(filters) {
    let query = new URLSearchParams();
    let key;
    for (key in filters) {
        query.append(key, filters[key]);
    }
    let response = await fetch("api/get-blog-list?" + query.toString());
    return (await response.json());
}
function getFilters() {
    let filters = {
        views_min: document.querySelector("#views_min").value,
        views_max: document.querySelector("#views_max").value,
        product: document.querySelector("#product").value,
        date_start: document.querySelector("#date_start").value,
        date_end: document.querySelector("#date_end").value,
        count: document.querySelector("#count").value,
    };
    return filters;
}
async function updateContent() {
    var _a;
    let blogs = await loadBlogList(getFilters());
    document.querySelector("#content").innerHTML = "";
    if (blogs.length) {
        for (let blog of blogs) {
            (_a = document.querySelector("#content")) === null || _a === void 0 ? void 0 : _a.append(makePreview(blog));
        }
    }
    else {
        document.querySelector("#content").innerHTML = `<p class="err">Подходящих статей не найдено!</p>`;
    }
}
updateContent();
document.querySelector("#filter").addEventListener("click", () => {
    updateContent();
});
