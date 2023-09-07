// TODO: Seperate the weekdays on courses
// TODO: Remove the filter on lite item when filtered by product

// @ts-ignore
const $ = window.jQuery; // Use jquery from wordpress

import { Navigation } from 'swiper/modules';
import Swiper from 'swiper';

Swiper.use([Navigation]);

class DateOverview {
	fetchedOnce: boolean = false;
	allDates: {
		year: number;
		month: number;
		dates: DateResponse[];
	}[] = [];
	dates: DateResponse[];
	calendar: DateOverviewCalendar;
	list: DateOverviewList;
	filter: DateOverviewFilter;
	selector: DateOverviewSelector;
	currentYear: number;
	currentMonth: number;

	constructor(
		calendarElement: HTMLElement,
		listElement: HTMLElement,
		filterElement: HTMLElement,
		selectorElement: HTMLElement
	) {
		this.calendar = new DateOverviewCalendar(calendarElement);
		this.list = new DateOverviewList(listElement);
		this.filter = new DateOverviewFilter(filterElement);
		this.selector = new DateOverviewSelector(selectorElement);

		this.initEventListeners();

		// Set current month
		this.showMonth(new Date().getFullYear(), new Date().getMonth() + 1);
	}

	showMonth(year: number, month: number) {
		// return if month is already set
		if (this.currentYear === year && this.currentMonth === month)
			throw new Error('Month is already set');

		// Set current month
		this.currentYear = year;
		this.currentMonth = month;

		// Check if dates of this month are already fetched
		if (this.fetchedOnce) {
			this.calendar.showMonth(year, month);
			this.list.showMonth(year, month);
		} else {
			this.fetchDates(year, month);
		}
	}

	initEventListeners() {
		this.calendar.onSelect((date) => {
			this.list.scrollToItem(date);
		});

		this.calendar.onNext(() => {
			// fetch data via ajax
			let year = this.currentYear;
			let month = this.currentMonth + 1;

			// Reset month and increase year
			if (month > 12) {
				year++;
				month = 1;
			}

			this.showMonth(year, month);
		});

		this.calendar.onPrev(() => {
			let year = this.currentYear;
			let month = this.currentMonth - 1;

			// Reset month and decrease year
			if (month < 1) {
				year--;
				month = 12;
			}

			this.showMonth(year, month);
		});

		this.filter.onFilterCategory((category) => {
			if (category === null) {
				this.calendar.setFilter(null);
				this.list.setFilter(null);
			} else {
				this.calendar.setFilter({
					type: 'category',
					year: this.currentYear,
					month: this.currentMonth,
					category,
				});
				this.list.setFilter({
					type: 'category',
					year: this.currentYear,
					month: this.currentMonth,
					category,
				});
			}

			this.selector.showProduct('');
		});

		this.list.onFilterProduct((productId, productCategory) => {
			this.calendar.setFilter({ type: 'product', productId });
			this.filter.setFilter(productCategory);
			this.selector.showProduct(productId);
		});

		this.selector.onSelect((productId, productCategory) => {
			this.list.setFilter({ type: 'product', productId });
			this.calendar.setFilter({ type: 'product', productId });
			this.filter.setFilter(productCategory);
			this.selector.showProduct(productId);
		});
	}

	async fetchDates(year: number, month: number) {
		const thisClone = this;

		await $.ajax({
			// @ts-ignore
			url: ajaxurl,
			type: 'POST',
			data: {
				action: 'date_overview_get_product_dates', // Dies sollte mit dem in add_action definierten Haken übereinstimmen
				year: year,
				month: month,
			},
			success: function (response) {
				thisClone.dates = response;

				const dates: DateResponse[] = response.data;

				// Fill calendar and list with data
				thisClone.calendar.fillGridData(dates);
				thisClone.list.fillListData(dates);
				thisClone.selector.fillSelectorData(dates);

				// Display month
				thisClone.calendar.showMonth(year, month);
				thisClone.list.showMonth(year, month);

				thisClone.fetchedOnce = true;
			},
		});
	}
}

/*------------------------------------*/
/* Calendar view */
/*------------------------------------*/
class DateOverviewCalendar {
	currentYear: number = new Date().getFullYear();
	currentMonth: number = new Date().getMonth() + 1;
	monthGrids: MonthGrid[] = [];
	filter: Filter = null;

	// Without default values
	container: HTMLElement;
	dates: DateResponse[];
	monthLabelSlider: Swiper;
	monthLabelSliderYear: Swiper;
	daysContainer: HTMLElement;

	// Event listeners
	private onSelectCallback: (date: string) => void;
	private onNextCallback: () => void;
	private onPrevCallback: () => void;

	constructor(container) {
		this.container = container;
		this.daysContainer = this.container.querySelector(
			'#date-overview__calendar__days'
		) as HTMLElement;

		this.generateEmptyMonthGrids(this.currentYear, this.currentMonth);
		this.initMonthLabelSlider();
	}

	/*------------------------------------*/
	/* Initialisation */
	/*------------------------------------*/
	generateEmptyMonthGrids(year: number, month: number) {
		// render empty object of type MonthGrid[] for the next 12 month
		for (let i = 0; i < 12; i++) {
			// start with current month and go on
			let forMonth = month + i;
			let forYear = year;

			// Reset month and increase year
			if (forMonth > 12) {
				forYear++;
				forMonth = forMonth - 12;
			}

			this.monthGrids.push(this.generateEmptyMonthGrid(forYear, forMonth));
		}
	}
	generateEmptyMonthGrid(year: number, month: number): MonthGrid {
		// Erster Tag des angegebenen Monats und Jahres
		const firstDayOfMonth = new Date(`${year}-${month.toString().padStart(2, '0')}-01`);
		firstDayOfMonth.setDate(firstDayOfMonth.getDate() - 1);

		// Erstelle den letzten Tag des angegebenen Monats und Jahres
		const lastDayOfMonth = new Date(year, month, 1);

		// Festlegen des Startdatums unter Berücksichtigung des ersten Wochentags
		const startDate = new Date(firstDayOfMonth);
		startDate.setDate(startDate.getDate() - ((startDate.getDay() + 6) % 7)); // Anpassung an den ersten Wochentag

		const monthGrid: MonthGridItem[] = [];

		// Days from last month
		while (startDate <= firstDayOfMonth) {
			monthGrid.push({
				date: startDate.toISOString().split('T')[0],
				day: startDate.getDate(),
				month: startDate.getMonth() + 1,
				currentMonth: false,
			});
			startDate.setDate(startDate.getDate() + 1);
		}

		// Days from current month
		while (startDate <= lastDayOfMonth) {
			monthGrid.push({
				date: startDate.toISOString().split('T')[0],
				day: startDate.getDate(),
				month: startDate.getMonth() + 1,
				currentMonth: true,
			});
			startDate.setDate(startDate.getDate() + 1);
		}

		// define maxcount to be evently divisible by 7 depending on current length of calendarGrid
		const maxCount = Math.ceil(monthGrid.length / 7) * 7;

		// Days from next month
		while (monthGrid.length < maxCount) {
			monthGrid.push({
				date: startDate.toISOString().split('T')[0],
				day: startDate.getDate(),
				month: startDate.getMonth() + 1,
				currentMonth: false,
			});
			startDate.setDate(startDate.getDate() + 1);
		}

		const monthGridObject: MonthGrid = {
			year,
			month,
			items: monthGrid,
		};

		// Add new monthGrid to this.monthGrids
		return monthGridObject;
	}
	initMonthLabelSlider() {
		const slider = this.container.querySelector('#calendar__month-slider .swiper-wrapper');
		const nextButton = this.container.querySelector('#calendar__next') as HTMLElement;
		const prevButton = this.container.querySelector('#calendar__prev') as HTMLElement;

		// Append a slide for each month with the month name and year
		this.monthGrids.forEach((monthGrid) => {
			const monthSlide = document.createElement('div');
			const monthLabel = Intl.DateTimeFormat('de-DE', {
				month: 'long',
				year: 'numeric',
			}).format(new Date(monthGrid.year, monthGrid.month - 1, 1));

			monthSlide.classList.add(
				'swiper-slide',
				'w-min',
				'whitespace-nowrap',
				'[&:not(:is(.swiper-slide-active))]:opacity-10',
				'transition-opacity',
				'duration-300'
			);
			monthSlide.innerHTML = monthLabel;

			slider?.appendChild(monthSlide);
		});

		this.monthLabelSlider = new Swiper('#calendar__month-slider', {
			slidesPerView: 'auto',
			centeredSlides: true,
			spaceBetween: 24,
			speed: 300,
			allowTouchMove: false,

			navigation: {
				nextEl: nextButton,
				prevEl: prevButton,
			},

			on: {
				navigationNext: () => {
					// Trigger onNext event
					if (this.onNextCallback) {
						this.onNextCallback();
					}
				},
				navigationPrev: () => {
					// Trigger onPrev event
					if (this.onPrevCallback) this.onPrevCallback();
				},
			},
		});

		if (!this.monthLabelSlider) throw new Error('No monthLabelSlider found');
	}
	public fillGridData(dates: DateResponse[]) {
		// TODO: Minimoze forEach calls

		// fill newDates with dates
		dates.forEach((date) => {
			const dateString = new Date(date.date).toISOString().split('T')[0];

			this.monthGrids.forEach((monthGrid) => {
				monthGrid.items.forEach((item) => {
					// add products to monthGrid if date and month and year match
					if (item.date === dateString) {
						if (!item.products) item.products = [];
						item.products.push(date.product);
					}
				});
			});
		});

		this.monthGrids.forEach((monthGrid) => {
			this.renderGridItems(monthGrid.year, monthGrid.month);
		});
	}

	/*------------------------------------*/
	/* Render functions */
	/*------------------------------------*/
	renderGridItems(year: number, month: number) {
		this.currentYear = year;
		this.currentMonth = month;

		const monthGrid = this.monthGrids.find(
			(monthGrid) => monthGrid.year === year && monthGrid.month === month
		)?.items as MonthGridItem[];

		if (!monthGrid) throw new Error('No monthGrid found');

		this.daysContainer.innerHTML = '';
		monthGrid.forEach((item) => {
			this.renderGridItem(item);
		});
	}
	renderGridItem(item: MonthGridItem) {
		// Append existing element
		if (item.element) {
			this.daysContainer.appendChild(item.element);
			return;
		}

		let templateQuery = '';
		if (item.currentMonth) {
			if (item.products) {
				templateQuery = '#template--date-overview__calendar__day--filled';
			} else {
				templateQuery = '#template--date-overview__calendar__day--empty';
			}
		} else {
			templateQuery = '#template--date-overview__calendar__day--other-month';
		}

		// Select template
		const template = document.querySelector(templateQuery) as HTMLTemplateElement;
		if (!template) throw new Error(`No template "${templateQuery}" found`);

		// Clone template
		const clone = template.content.cloneNode(true) as HTMLElement;

		// Add item to list
		this.daysContainer.appendChild(clone);

		// select currently added item
		const element = this.daysContainer.lastElementChild as HTMLElement;
		item.element = element;

		// select by template-month attribute
		const day = element.querySelector('[template-day]') as HTMLElement;
		if (!day) throw new Error('No day found');
		// add formatted day from this.currentMonth using Intl.DateTimeFormat
		day.innerHTML = new Intl.DateTimeFormat('de-DE', {
			day: 'numeric',
		}).format(new Date(item.date));

		// Return of item is not in current month
		if (!item.currentMonth) return;

		// data-product-ids="<?= $productIds ?>" data-product-categories="<?= $productCategories ?>" data-date="<?= $date['date'] ?>" data-active="true"
		const productIds = item.products?.map((product) => product.ID).join(',');
		element.dataset.productIds = productIds;

		const productCategories = item.products?.map((product) => product.category).join(',');
		element.dataset.productCategories = productCategories;

		element.dataset.date = item.date;

		// Add event listener
		element.addEventListener('click', (e) => {
			const target = e.currentTarget as HTMLElement;
			const date = target.dataset.date;

			// Do nothing when button is inactive
			if (target.dataset.active === 'false') return;

			// Error handling
			if (!date) throw new Error('No date found');

			// Trigger onSelect event
			if (this.onSelectCallback) this.onSelectCallback(date);
		});

		// Add product parts
		if (item.products) {
			// Add event listener
			item.element.addEventListener('click', () => {
				// Trigger onSelect event
				if (this.onSelectCallback) this.onSelectCallback(item.date);
			});

			item.products.forEach((product) => {
				const container = element.querySelector(
					'#date-overview__calendar__day__slide__color-container'
				);

				if (!container) throw new Error('No container found');

				// this.renderProductPart(item, product);
				const template = document.querySelector(
					'#template--date-overview__calendar__day__color-slice'
				) as HTMLTemplateElement;

				if (!template)
					throw new Error(
						'No template "#template--date-overview__calendar__day__color-slice" found'
					);

				// Clone template
				const clone = template.content.cloneNode(true) as HTMLElement;

				// Add item to list
				container.appendChild(clone);

				// select currently added item
				const slice = container.lastElementChild as HTMLElement;

				// data-product-id="<?= $product['ID'] ?>" data-product-category="<?= $product['category'] ?>" data-active="true"
				slice.dataset.productId = product.ID.toString();
				slice.dataset.productCategory = product.category;

				slice.style.backgroundColor = `var(--color-${product.category})`;
			});
		}
	}

	/*------------------------------------*/
	/* Public functions */
	/*------------------------------------*/
	public showMonth(year: number, month: number) {
		this.renderGridItems(year, month);

		const monthIndex = this.monthGrids.findIndex(
			(monthGrid) => monthGrid.year === year && monthGrid.month === month
		);
		this.monthLabelSlider.slideTo(monthIndex);
	}
	public setFilter(filter: Filter) {
		// Reset filter when filter is null
		if (filter?.type === 'product' && filter.productId === 0) filter = null;

		this.filter = filter;

		// Set active state of all buttons
		this.monthGrids.forEach((monthGrid) => {
			monthGrid.items.forEach((item) => {
				if (!item.element) throw new Error('No button found');

				// Activate all buttons when identifier is null
				if (filter === null) {
					item.element.dataset.active = 'true';
				}

				// Filter by category
				if (filter?.type === 'category') {
					const categories: Category[] = [];
					item.products?.forEach((product) => {
						categories.push(product.category);
					});
					item.element.dataset.active = categories.includes(filter.category).toString(); // Activate slice if productCategory matches
				}

				// Filter by product
				if (filter?.type === 'product') {
					const productIds: number[] = [];
					item.products?.forEach((product) => {
						productIds.push(product.ID);
					});
					item.element.dataset.active = productIds.includes(filter.productId).toString(); // Activate slice if productId matches
				}

				// Set color slices active state
				const colorSlices = item.element.querySelectorAll(
					'#date-overview__calendar__day__color-slice'
				) as NodeListOf<HTMLElement>;

				colorSlices.forEach((slice) => {
					// active all buttons when identifier is null
					if (filter === null) {
						slice.dataset.active = 'true';
					}

					// Filter by category
					if (filter?.type === 'category') {
						const category = slice.dataset.productCategory as Category;
						slice.dataset.active = (category === filter.category).toString(); // Activate slice if productCategory matches
					}

					// Filter by product
					if (filter?.type === 'product') {
						const productId = Number(slice.dataset.productId);
						slice.dataset.active = (productId === filter.productId).toString(); // Activate slice if productId matches
					}
				});
			});
		});

		// Show the first month with the filtedes product
		if (filter?.type === 'product') {
			if (filter.productId !== 0) {
				// Get month of the first monthGrid with the given productId
				const firstMonth = this.monthGrids.find((monthGrid) => {
					const monthGridItem = monthGrid.items.find((item) => {
						if (!item.products) return false;
						return item.products.find((product) => product.ID === filter.productId);
					});

					return monthGridItem !== undefined;
				});
				this.showMonth(firstMonth?.year as number, firstMonth?.month as number);
			} else {
				const firstMonth = this.monthGrids[0];
				this.showMonth(firstMonth?.year as number, firstMonth?.month as number);
			}
		}
	}

	/*------------------------------------*/
	/* Event listeners */
	/*------------------------------------*/
	public onSelect(callback: (date: string) => void) {
		this.onSelectCallback = callback;
	}
	public onNext(callback: () => void) {
		this.onNextCallback = callback;
	}
	public onPrev(callback: () => void) {
		this.onPrevCallback = callback;
	}
}

/*------------------------------------*/
/* List view */
/*------------------------------------*/
class DateOverviewList {
	currentYear: number = new Date().getFullYear();
	currentMonth: number = new Date().getMonth() + 1;
	monthLists: MonthList[] = [];
	filter: Filter = null;

	// Without default values
	container: HTMLElement;
	dates: DateResponse[];

	// Event listeners
	private onFilterProductCallback: (productId: number, productCategory: Category) => void;

	constructor(container) {
		this.container = container;

		this.generareEmptyMonthLists(this.currentYear, this.currentMonth);
	}

	/*------------------------------------*/
	/* Initialisation */
	/*------------------------------------*/
	generareEmptyMonthLists(year: number, month: number) {
		// render empty object of type MonthGrid[] for the next 12 month
		for (let i = 0; i < 12; i++) {
			// start with current month and go on
			let forMonth = month + i;
			let forYear = year;

			// Reset month and increase year
			if (forMonth > 12) {
				forYear++;
				forMonth = forMonth - 12;
			}

			this.monthLists.push({
				year: forYear,
				month: forMonth,
				items: [],
			});
		}
	}
	public fillListData(dates: DateResponse[]) {
		// TODO: Minimoze forEach calls

		// fill newDates with dates
		dates.forEach((date) => {
			// get year and month of date
			const dateYear = new Date(date.date).getFullYear();
			const dateMonth = new Date(date.date).getMonth() + 1;
			const dateDay = new Date(date.date).getDate();

			// date.date.date as string
			const dateString = new Date(date.date).toISOString().split('T')[0];

			const monthList = this.monthLists.find(
				(monthList) => monthList.year === dateYear && monthList.month === dateMonth
			) as MonthList;

			if (!monthList.items) monthList.items = [];
			monthList.items.push({
				date: dateString,
				day: dateDay,
				month: dateMonth,
				product: date.product,
			});
		});

		this.monthLists.forEach((monthList) => {
			this.showMonth(monthList.year, monthList.month);
		});
	}

	/*------------------------------------*/
	/* Render functions */
	/*------------------------------------*/
	// Display all dates by month
	renderMonthDatesList(year: number, month: number) {
		this.currentYear = year;
		this.currentMonth = month;

		const monthList = this.monthLists.find(
			(monthList) => monthList.year === year && monthList.month === month
		)?.items as MonthListItem[];

		if (!monthList) throw new Error('No monthList found');

		this.container.innerHTML = '';

		this.renderListMonth(year, month);
		monthList.forEach((item) => {
			this.renderListItem(item);
		});
	}
	renderMonthCategoryDatesList(year: number, month: number, cateogry: Category) {
		// get all dates of the month with the given category
		const monthList = this.monthLists.find(
			(monthList) => monthList.year === year && monthList.month === month
		)?.items as MonthListItem[];

		if (!monthList) throw new Error('No monthList found');

		const categoryDates = monthList.filter((item) => item.product?.category === cateogry);

		// Remove old content
		this.container.innerHTML = '';

		// Append a new section element for each month
		this.renderListMonth(year, month);
		categoryDates.forEach((item) => {
			this.renderListItem(item);
		});
	}
	// Display all dates of a product in month sections
	renderProductDatesList(productId: number) {
		// Create MonthList object for all dates of the product
		const productDates: MonthList[] = [];
		this.monthLists.forEach((monthList) => {
			const monthDates = monthList.items.filter((item) => item.product?.ID === productId);
			productDates.push({
				year: monthList.year,
				month: monthList.month,
				items: monthDates,
			});
		});

		if (!productDates) throw new Error('No productDates found');

		// Remove old content
		this.container.innerHTML = '';

		// Append a new section element for each month
		productDates.forEach((monthList) => {
			// Return of month has no dates
			if (monthList.items.length === 0) return;

			this.renderListMonth(monthList.year, monthList.month);

			monthList.items.forEach((item) => {
				this.renderListItem(item);
			});
		});
	}
	// Render a single date item
	renderListItem(item: MonthListItem) {
		// TODO: Add two modes: show group or show weekday for courses

		// Append existing element
		if (item.element) {
			this.container.appendChild(item.element);
			return;
		}

		if (!item.product) throw new Error('No product found');

		const template = document.querySelector(
			'#template--date-overview__list__item'
		) as HTMLTemplateElement;

		if (!template) throw new Error('No template "#template--date-overview__list__item" found');

		// Clone template
		const clone = template.content.cloneNode(true) as HTMLElement;

		// Add item to list
		this.container.appendChild(clone);

		// select currently added item
		const element = this.container.lastElementChild as HTMLElement;
		item.element = element;

		element.style.color = `var(--color-${item.product?.category})`;

		// select by template-month attribute
		const month = element.querySelector('[template-month]') as HTMLElement;
		if (!month) throw new Error('No month found');
		// add formatted month from this.currentMonth using Intl.DateTimeFormat
		month.innerHTML = new Intl.DateTimeFormat('de-DE', {
			month: 'short',
		}).format(new Date(item.date));

		const day = element.querySelector('[template-day]') as HTMLElement;
		if (!day) throw new Error('No day found');
		// add formatted day from this.currentMonth using Intl.DateTimeFormat
		day.innerHTML = new Intl.DateTimeFormat('de-DE', {
			day: 'numeric',
		}).format(new Date(item.date));

		const title = element.querySelector('[template-title]') as HTMLElement;
		if (!title) throw new Error('No title found');
		// add formatted day from this.currentMonth using Intl.DateTimeFormat
		title.innerHTML = item.product.title;

		const category = element.querySelector('[template-category]') as HTMLElement;
		if (!category) throw new Error('No category found');
		// add formatted day from this.currentMonth using Intl.DateTimeFormat
		category.innerHTML = item.product.category;

		// TODO: Add booking URL
		// const bookingButton = item.querySelector(
		// 	"[template-booking-button]"
		// ) as HTMLLinkElement;
		// if (!bookingButton) throw new Error("No booking button found");
		// // add formatted day from this.currentMonth using Intl.DateTimeFormat
		// bookingButton.href = date.product.;

		const filterButton = element.querySelector('[template-filter-button]') as HTMLElement;
		if (!filterButton) throw new Error('No filter button found');

		// Add event listener
		filterButton.addEventListener('click', () => {
			if (!item.product) throw new Error('No product ID found');

			this.setFilter({
				type: 'product',
				productId: item.product.ID,
			});

			// Trigger onFilterProduct event
			this.onFilterProductCallback(item.product.ID, item.product.category);
		});
	}
	// Render a month label
	renderListMonth(year: number, month: number) {
		const template = document.querySelector(
			'#template--date-overview__list__month'
		) as HTMLTemplateElement;
		if (!template) throw new Error('No template "#template--date-overview__list__month" found');

		// Clone template
		const clone = template.content.cloneNode(true) as HTMLElement;

		// Add item to list
		this.container.appendChild(clone);

		const monthElement = this.container.lastElementChild as HTMLElement;

		const label = monthElement.querySelector('[template-label]') as HTMLElement;
		if (!label) throw new Error('No label found');

		label.innerHTML = new Intl.DateTimeFormat('de-DE', {
			month: 'long',
			// year: "numeric",
		}).format(new Date(year, month - 1));
	}

	/*------------------------------------*/
	/* Misc */
	/*------------------------------------*/
	getCurrentMonthList() {
		const monthList = this.monthLists.find(
			(monthList) =>
				monthList.year === this.currentYear && monthList.month === this.currentMonth
		)?.items as MonthListItem[];

		if (!monthList) throw new Error('No monthList found');

		return monthList;
	}

	/*------------------------------------*/
	/* Public functions */
	/*------------------------------------*/
	public showMonth(year: number, month: number) {
		if (!this.filter) {
			this.renderMonthDatesList(this.currentYear, this.currentMonth);
			return;
		}

		if (this.filter.type === 'category') {
			this.renderMonthCategoryDatesList(
				this.filter.year,
				this.filter.month,
				this.filter.category
			);
			return;
		}

		if (this.filter.type === 'product') {
			this.renderProductDatesList(this.filter.productId);
			return;
		}
	}
	public setFilter(filter: Filter) {
		// Reset filter when filter is null
		if (filter?.type === 'product' && filter.productId === 0) filter = null;

		this.filter = filter;
		this.showMonth(this.currentYear, this.currentMonth);
	}
	public scrollToItem(date: string) {
		// TODO: Add short animation to catch attention

		const monthList = this.getCurrentMonthList();
		monthList.forEach((item) => {
			if (item.date === date) {
				item.element?.scrollIntoView({
					behavior: 'smooth',
				});
				return;
			}
		});
	}

	/*------------------------------------*/
	/* Event listeners */
	/*------------------------------------*/
	public onFilterProduct(callback: (productId: number, productCategory: Category) => void) {
		this.onFilterProductCallback = callback;
	}
}

/*------------------------------------*/
/* Filter component */
/*------------------------------------*/
class DateOverviewFilter {
	// Without default values
	container: HTMLElement;
	category: CategoryFilter;
	buttons: NodeListOf<HTMLElement>;

	// Event listeners
	private onFilterCategoryCallback: (category: CategoryFilter) => void;

	constructor(container) {
		this.container = container;
		this.buttons = this.container.querySelectorAll('#date-overview__filter__button');

		// Error handling
		if (!this.buttons) throw new Error('No buttons found');

		this.initEventListeners();
	}

	/*------------------------------------*/
	/* Initialisaton */
	/*------------------------------------*/
	initEventListeners() {
		this.buttons.forEach((button) => {
			button.addEventListener('click', () => {
				// Set category
				const category = button.dataset.category as Category;
				if (category !== this.category) {
					this.setFilter(category);
				} else {
					this.setFilter(null);
				}

				// Trigger onFilterCategory event
				if (this.onFilterCategoryCallback) this.onFilterCategoryCallback(this.category);
			});
		});
	}

	/*------------------------------------*/
	/* Renser functions */
	/*------------------------------------*/
	setButtonState(element: HTMLElement, state: FilterButtonState) {
		if (state == 'unselected') {
			element.dataset.selected = 'false';
			element.dataset.active = 'true';
		} else if (state == 'selected') {
			element.dataset.selected = 'true';
			element.dataset.active = 'true';
		} else if (state == 'inactive') {
			element.dataset.selected = 'false';
			element.dataset.active = 'false';
		} else {
			throw new Error('Invalid button state');
		}
	}

	/*------------------------------------*/
	/* Public functions */
	/*------------------------------------*/
	public setFilter(category: CategoryFilter) {
		// Set button states
		this.buttons.forEach((button) => {
			if (category === null) {
				this.setButtonState(button, 'unselected');
			} else {
				if (button.dataset.category === category) {
					this.setButtonState(button, 'selected');
				} else {
					this.setButtonState(button, 'inactive');
				}
			}
		});

		// Set category
		this.category = category;
	}

	/*------------------------------------*/
	/* Event listeners */
	/*------------------------------------*/
	public onFilterCategory(callback: (category: CategoryFilter) => void) {
		this.onFilterCategoryCallback = callback;
	}
}

/*------------------------------------*/
/* Product selector */
/*------------------------------------*/
class DateOverviewSelector {
	selectorOptions: SelectorOption[] = [];

	// Without default values
	container: HTMLElement;
	products: ProductType[];
	select: HTMLSelectElement;
	productTitle: HTMLElement;
	productCategory: HTMLElement;
	productImage: HTMLElement;
	label: HTMLElement;
	selected: number;

	// Event listeners
	private onSelectCallback: (productId: number, productCategory: Category) => void;

	constructor(container) {
		this.container = container;
		this.select = this.container.querySelector('select') as HTMLSelectElement;
		this.label = this.container.querySelector('label') as HTMLElement;
		this.productTitle = this.container.querySelector('[template-product-title]') as HTMLElement;
		this.productCategory = this.container.querySelector(
			'[template-product-category]'
		) as HTMLElement;
		this.productImage = this.container.querySelector('[template-product-image]') as HTMLElement;

		// Error handling
		if (!this.productTitle || !this.productCategory || !this.productImage)
			throw new Error('No product title, category or image found');
		if (!this.select || !this.label) throw new Error('No select or label element found');

		this.initEventListeners();
	}

	/*------------------------------------*/
	/* Initialisation */
	/*------------------------------------*/
	initEventListeners() {
		this.select.addEventListener('change', (e) => {
			const target = e.currentTarget as HTMLSelectElement;
			const productId = Number(target.value);
			const productCategory = target.selectedOptions[0].dataset.productCategory as Category;

			// Trigger onSelect event
			if (this.onSelectCallback) this.onSelectCallback(productId, productCategory);

			this.selected = productId;
		});
	}
	fillSelectorData(dates: DateResponse[]) {
		// Create array of all products without duplicates
		const products = dates.map((date) => date.product);
		const uniqueProducts = products.filter(
			(product, index, self) => index === self.findIndex((p) => p.ID === product.ID)
		);

		// Sort products by title
		uniqueProducts.sort((a, b) => {
			if (a.title < b.title) return -1;
			if (a.title > b.title) return 1;
			return 0;
		});

		this.products = uniqueProducts;
		this.renderOptions();
	}

	/*------------------------------------*/
	/* Render functions */
	/*------------------------------------*/
	renderOptions() {
		console;
		this.products.forEach((product) => {
			this.renderOption(product);
		});
	}
	renderOption(product: ProductType) {
		this.select.innerHTML += `<option value="${product.ID}">${product.title}</option>`;

		// Add event listener
		const option = this.select.querySelector(
			`option[value="${product.ID}"]`
		) as HTMLOptionElement;
		if (!option) throw new Error('No option found');

		option.dataset.productCategory = product.category;
	}
	renderOptionLabel(productId: number | '') {
		if (productId === '' || productId === 0) {
			this.productTitle.innerHTML = 'Kein Produkt ausgewählt';
			this.productCategory.innerHTML = '';
			return;
		}

		const product = this.products.find((product) => product.ID === productId);
		if (!product) throw new Error('No product found');

		this.productTitle.innerHTML = product.title;
		this.productCategory.innerHTML = product.category;
		this.productCategory.style.backgroundColor = `var(--color-${product.category})`;
	}

	/*------------------------------------*/
	/* Public functions */
	/*------------------------------------*/
	public showProduct(productId: number | '') {
		this.select.value = productId.toString();
		this.renderOptionLabel(productId);
	}

	/*------------------------------------*/
	/* Event listeners */
	/*------------------------------------*/
	public onSelect(callback: (productId: number, productCategory: Category) => void) {
		this.onSelectCallback = callback;
	}
}

/*------------------------------------*/
/* Init component */
/*------------------------------------*/
const calendarElement = document.querySelector('#date-overview__calendar') as HTMLElement;
const listElement = document.querySelector('#date-overview__list') as HTMLElement;
const filterElement = document.querySelector('#date-overview__filter') as HTMLElement;
const selectorElement = document.querySelector('#date-overview__selector') as HTMLElement;

if (!calendarElement || !listElement || !filterElement || !selectorElement)
	throw new Error('No calendar, list or filter element found');

new DateOverview(calendarElement, listElement, filterElement, selectorElement);

/*------------------------------------*/
/* Type definitions */
/*------------------------------------*/

// Enums
type Category = 'course-child' | 'course-adult' | 'workshop' | 'holiday_workshop';
type FilterButtonState = 'unselected' | 'selected' | 'inactive';

// Month grid
type Filter =
	| {
			type: 'product';
			productId: number;
	  }
	| {
			type: 'category';
			year: number;
			month: number;
			category: Category;
	  }
	| null;

type MonthGrid = {
	month: number;
	year: number;
	items: MonthGridItem[];
};
type MonthGridItem = {
	date: string;
	day: number;
	month: number;
	currentMonth: boolean;
	element?: HTMLElement;
	products?: ProductType[];
};

// Month list
type MonthList = {
	month: number;
	year: number;
	items: MonthListItem[];
};
type MonthListItem = {
	date: string;
	day: number;
	month: number;
	element?: HTMLElement;
	product?: ProductType;
};

// Selector
type SelectorOption = {
	month: number;
	year: number;
	items: MonthListItem[];
};

// API response
type ProductType = {
	ID: number;
	starttime: string;
	endtime: string;
	title: string;
	category: Category;
	group: {
		value: string;
		label: string;
	};
};
type DateResponse = {
	date: string;
	product: ProductType;
	listElement?: HTMLElement;
};

type CategoryFilter = Category | null;
