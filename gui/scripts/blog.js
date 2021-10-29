var _a;
function makePreview(blog) {
    let div = document.createElement("div");
    div.innerHTML = `<article>
                        <h2>${blog.title}</h2>
                        <p>${blog.description}</p>
                        <p class="views">Views: ${blog.views}</p>
                    </article>`;
    div.addEventListener("click", () => {
        window.location.href = "blog/" + blog.href;
    });
    return div;
}
function makeBlog(blog) {
    var _a;
    let div = document.createElement("div");
    document.title = (_a = blog.title) !== null && _a !== void 0 ? _a : "Blog not found!";
    div.innerHTML = blog
        ? ` <header><h1>${blog.title}</h1></header>
            <section>
                <time>${new Date(blog.time_create * 1000).toLocaleString()}</time>
                ${blog.body.replace('"', '"').replace("/", "/")}
            </section>`
        : `<p class="err">Blog not found!</p>`;
    return div;
}
async function loadBlog(href) {
    let response = await fetch("/api/get-blog?href=" + href);
    return (await response.json());
}
(async function showBlogContent() {
    var _a;
    let href = window.location.pathname.split("/").pop();
    if (href) {
        let blog = await loadBlog(href);
        (_a = document.querySelector("#content")) === null || _a === void 0 ? void 0 : _a.append(makeBlog(blog));
    }
})();
(_a = document.querySelector("#close")) === null || _a === void 0 ? void 0 : _a.addEventListener("click", () => {
    window.location.href = "/";
});
export { makePreview };
