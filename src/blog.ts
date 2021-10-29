import {IBlog} from "./types.js";

function makePreview(blog: IBlog): HTMLElement {
	let div: HTMLDivElement = document.createElement("div");
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

function makeBlog(blog: IBlog): HTMLElement {
	let div: HTMLDivElement = document.createElement("div");
	document.title = blog.title ?? "Blog not found!";
	div.innerHTML = blog
		? ` <header><h1>${blog.title}</h1></header>
            <section>
                <time>${new Date((blog.time_create as number) * 1000).toLocaleString()}</time>
                ${blog.body.replace('"', '"').replace("/", "/")}
            </section>`
		: `<p class="err">Blog not found!</p>`;
	return div;
}

async function loadBlog(href: string): Promise<IBlog> {
	let response = await fetch("/api/get-blog?href=" + href);
	return (await response.json()) as IBlog;
}

(async function showBlogContent() {
	let href = window.location.pathname.split("/").pop() as string;
	if (href) {
		let blog: IBlog = await loadBlog(href);
		document.querySelector("#content")?.append(makeBlog(blog));
	}
})();

document.querySelector("#close")?.addEventListener("click", () => {
	window.location.href = "/";
});

export {makePreview};
