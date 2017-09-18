<template>
	<v-container
		fluid
		style="padding: 0"
		grid-list-lg
	>
		<v-parallax height="700" src="https://vuetifyjs.com/static/doc-images/vbanner.jpg">
			<v-layout column align-center justify-center>
				<h1 class="white--text">Drew Roberts</h1>
			</v-layout>
		</v-parallax>
		<v-layout style="max-width: 970px; padding:17px" row wrap>
			<v-flex xs12 sm6 offset-sm3>
				<v-card light>
					<v-card-media
						class="white--text"
						height="200px"
						src="https://vuetifyjs.com/static/doc-images/cards/desert.jpg"
					>
						<v-container fill-height fluid>
							<v-layout fill-height>
								<v-flex xs12 align-end flexbox>
									<span class="headline">Top 10 Florida beaches</span>
								</v-flex>
							</v-layout>
						</v-container>
					</v-card-media>
					<v-card-title>
						<div>
							<span class="grey--text">Number 10</span><br>
							<span>Whitehaven Beach</span><br>
							<span>Whitsunday Island, Whitsunday Islands</span>
						</div>
					</v-card-title>
					<v-card-actions>
						<v-btn flat class="orange--text">Explore</v-btn>
					</v-card-actions>
				</v-card>
			</v-flex>
		</v-layout>
	</v-container> 
</template>

<script>

</script>