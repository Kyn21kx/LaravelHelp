import React from 'react';
import ReactDOM from 'react-dom';

export default function HeaderRender(props) {
	return (
		<header class="bg-dark py-5">
			<div class="container px-4 px-lg-5 my-5">
				<div class="text-center text-white">
					<h1 class="display-4 fw-bolder">{props.name}</h1>
					<p class="lead fw-normal text-white-50 mb-0">{props.subtitle}</p>
				</div>
			</div>
		</header>
	);
}

if (document.getElementById('header')) {
	const element = document.getElementById('header');
	ReactDOM.render(<HeaderRender name={element.getAttribute('name')} subtitle={element.getAttribute('subtitle')}/>, element);
}