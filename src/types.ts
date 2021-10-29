interface IBlog {
	href: string;
	title: string;
	body: string;
	description: string;
	product: string;
	views: number;
	time_create: number;
}

interface IFilters {
	views_min: number;
	views_max: number;
	product: string;
	date_start: string;
	date_end: string;
	count: number;
}

export {IBlog, IFilters};
