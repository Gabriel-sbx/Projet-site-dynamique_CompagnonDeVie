
<article class=" card card-list col-md-4 mx-3 my-3">
	<figure class=" col-auto d-none d-lg-block card-image">

    <img src="assets/images/event/{$objEvent->getPicture()}" alt="{$objEvent->getName()}" />
	</figure>
	
	<div class="card-header">
		<h3>{$objEvent->getName()}</h3>
		{*
		<button class="icon-button">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" display="block" id="Heart">
				<path d="M7 3C4.239 3 2 5.216 2 7.95c0 2.207.875 7.445 9.488 12.74a.985.985 0 0 0 1.024 0C21.125 15.395 22 10.157 22 7.95 22 5.216 19.761 3 17 3s-5 3-5 3-2.239-3-5-3z" />
			</svg>
		</button>
		*}
	</div>
	<div class="card-footer d-flex">
		<div class="card-meta card-meta--views">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" display="block" id="EyeOpen">
				<path d="M21.257 10.962c.474.62.474 1.457 0 2.076C19.764 14.987 16.182 19 12 19c-4.182 0-7.764-4.013-9.257-5.962a1.692 1.692 0 0 1 0-2.076C4.236 9.013 7.818 5 12 5c4.182 0 7.764 4.013 9.257 5.962z" />
				<circle cx="12" cy="12" r="3" />
			</svg>
			{$objEvent->getDescription()}
		</div>
		<div class="card-meta card-meta--date">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" display="block" id="Calendar">
				<rect x="2" y="4" width="20" height="18" rx="4" />
				<path d="M8 2v4" />
				<path d="M16 2v4" />
				<path d="M2 10h20" />
			</svg>
			le : {$objEvent->getDate()}</p>
		</div>
	</div>
	{*
	<div class=" text-center">
		<button class=" mt-3 px-3 btn-action" href="#">S'inscrire</button>
	</div>
	*}
</article>