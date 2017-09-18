<template>
    <v-app id="example-8" toolbar>
    <v-navigation-drawer absolute persistent light v-model="drawer" overflow>
      <v-list class="pa-1">
        <div style="width:200px;margin:auto;padding-top:10px;padding-bottom:10px;">
          <v-list-tile-avatar tag="div" size="200px">
            <img src="/img/drewroberts.jpg" />
          </v-list-tile-avatar>
        </div>
      </v-list>
      <v-list class="pt-0" dense>
        <v-divider light></v-divider>
        <v-list-tile v-for="item in items" :key="item.title" @click="">
          <v-list-tile-action>
            <v-icon light>{{ item.icon }}</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ item.title }}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar fixed dark dense class="indigo darken-4">
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
              <v-toolbar-title>Drew Roberts</v-toolbar-title>
              <v-spacer></v-spacer>
              <v-bottom-sheet>
                    <v-btn slot="activator" icon class="amber--text">
                      <v-icon>mdi-comment-account-outline</v-icon>
                    </v-btn>
                  <v-list>
                    <v-subheader>Reach out to me through:</v-subheader>
                    <v-list-tile href="https://www.facebook.com/DrewRoberts">
                          <v-list-tile-avatar>
                            <v-icon medium>mdi-facebook-box</v-icon>
                          </v-list-tile-avatar>
                          <v-list-tile-title>@DrewRoberts</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile href="https://twitter.com/DrewRoberts">
                          <v-list-tile-avatar>
                            <v-icon medium>mdi-twitter</v-icon>
                          </v-list-tile-avatar>
                          <v-list-tile-title>@DrewRoberts</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile href="https://www.linkedin.com/in/DrewRoberts">
                          <v-list-tile-avatar>
                            <v-icon medium>mdi-linkedin-box</v-icon>
                          </v-list-tile-avatar>
                          <v-list-tile-title>/DrewRoberts</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile href="https://github.com/DrewRoberts">
                          <v-list-tile-avatar>
                            <v-icon medium>mdi-github-circle</v-icon>
                          </v-list-tile-avatar>
                          <v-list-tile-title>@DrewRoberts</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile href="https://plus.google.com/+DrewRoberts">
                          <v-list-tile-avatar>
                            <v-icon medium>mdi-google-plus-box</v-icon>
                          </v-list-tile-avatar>
                          <v-list-tile-title>+DrewRoberts</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile href="mailto:website@drewroberts.com?Subject=Hello%20Drew">
                          <v-list-tile-avatar>
                            <v-icon medium>mdi-comment-text-outline</v-icon>
                          </v-list-tile-avatar>
                          <v-list-tile-title>Contact Form</v-list-tile-title>
                    </v-list-tile>
                  </v-list>
                </v-bottom-sheet>
        </v-toolbar>
        
        <main class="grey lighten-4">
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
                <span class="headline">Top 10 Australian beaches</span>
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
        </main>        
    </v-app>
</template>

<script>
  export default {
    data () {
      return {
        drawer: null,
        items: [
          { title: 'Home', icon: 'dashboard' },
          { title: 'About', icon: 'question_answer' }
        ],
        mini: false,
        right: null
      }
    }
  }
</script>
