import $ from './std-js/zq.es6';

export function openModal() {
	document.querySelector(this.dataset.showModal).showModal();
}

export function closeModal() {
	document.querySelector(this.dataset.close).close();
}

export function toggleDetails(click) {
	let details = click.target.parentElement;
	details.hasAttribute('open')
		? details.removeAttribute('open')
		: details.setAttribute('open', '');
}
