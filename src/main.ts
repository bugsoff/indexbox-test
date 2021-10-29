import {IBlog, IFilters} from "./types.js";
import {makePreview} from "./blog.js";

async function loadBlogList(filters: IFilters): Promise<IBlog[]> {
	let query = new URLSearchParams();
	let key: keyof IFilters;
	for (key in filters) {
		query.append(key, filters[key] as string);
	}
	let response = await fetch("api/get-blog-list?" + query.toString());
	return (await response.json()) as IBlog[];
}

function getFilters(): IFilters {
	let filters: IFilters = {
		views_min: (<any>(<HTMLInputElement>document.querySelector("#views_min")).value) as number,
		views_max: (<any>(<HTMLInputElement>document.querySelector("#views_max")).value) as number,
		product: (<HTMLSelectElement>document.querySelector("#product")).value,
		date_start: (<HTMLInputElement>document.querySelector("#date_start")).value,
		date_end: (<HTMLInputElement>document.querySelector("#date_end")).value,
		count: (<any>(<HTMLSelectElement>document.querySelector("#count")).value) as number,
	};
	return filters;
}

async function updateContent(): Promise<void> {	
	let blogs: IBlog[] = await loadBlogList(getFilters());
	(<HTMLInputElement>document.querySelector("#content")).innerHTML = "";
	if (blogs.length) {
		for (let blog of blogs) {
			document.querySelector("#content")?.append(makePreview(blog));
		}
	} else {
        (<HTMLDivElement>document.querySelector("#content")).innerHTML=`<p class="err">Подходящих статей не найдено!</p>`;
	}	
}

updateContent();

(<HTMLButtonElement>document.querySelector("#filter")).addEventListener("click", () => {
	updateContent();
});
