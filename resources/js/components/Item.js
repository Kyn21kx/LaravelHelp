import ReactDOM from 'react-dom';

export default function ItemRender(props) {
	return (
		<div class="col mb-5">
			<div class="card h-100">
				<div class="badge bg-dark text-white position-absolute" style={{top: '0.5rem', right: '0.5rem'}}>Disponibles: {props.stock.Available}</div>
				<img class="card-img-top" src={props.item.Picture.replaceAll("\\", "")} alt="..." />
				<div class="card-body p-4">
					<div class="text-center">
						<h5 class="fw-bolder">{props.item.Description}</h5>
						<span class="text-muted text-decoration-line-through">${(props.item.Price * 1.15).toFixed(2)}</span>
						${props.item.Price.toFixed(2)}
					</div>
				</div>
				<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
					<div class="text-center"><button class="btn btn-outline-dark mt-auto" onClick={() => buyAndAlert(props.stock.InstrumentId)}>Comprar</button></div>
				</div>
			</div>
		</div>
	);
}
//arreglo
const toApply = document.getElementsByName('saleItem');



toApply.forEach(element => {
	//Por cada elemento que tenga el nombre sale item
	let jsonItem = element.getAttribute('item'); //Representación JSON del instrumento
	let jsonStock = element.getAttribute('stock'); //Representación JSON del contador de inventario
	const inlineItem = JSON.parse(jsonItem); //Convertimos a objeto de Javascript
	const inlineStock = JSON.parse(jsonStock);
	console.log(inlineStock);
	ReactDOM.render(<ItemRender item={inlineItem} stock={inlineStock}/>, element);
});	

function buyAndAlert(InstrumentId) {
	console.log("Id: " + InstrumentId);
	let form = document.getElementById("buyForm");
	form.action += InstrumentId; //Action = instruments/buy/{InstrumentId}
	//form = addDataToForm(form, {'id': InstrumentId});
	console.log(form);
	form.submit();
}