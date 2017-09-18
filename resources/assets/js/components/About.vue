<template>
		<v-container
			fluid
			style="max-width: 970px;"
			grid-list-lg
		>
			<v-layout row wrap>
				<v-flex xs12 sm6 offset-sm3>
					<v-card light>
						<v-card-media
							class="white--text"
							height="200px"
							src="https://vuetifyjs.com/static/doc-images/cards/docks.jpg"
						>
							<v-container fill-height fluid>
								<v-layout fill-height>
									<v-flex xs12 align-end flexbox>
										<span class="headline">About</span>
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
							<v-btn flat class="orange--text">Share</v-btn>
							<v-btn flat class="orange--text">Explore</v-btn>
						</v-card-actions>
					</v-card>
				</v-flex>
			</v-layout>
		</v-container> 
</template>

<script>

</script>