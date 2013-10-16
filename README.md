-newsHack
=========

Initial idea..

To produce a force directed graph http://en.wikipedia.org/wiki/Force-directed_graph_drawing using data collected via BBC Juicer using the users news interests, This in turn use the twitter API to determine who out of the people you follow have tweeted about the story pulled via juicer.. We should try and collect more than one interest perhaps using comma delimition

The main thrust of the idea is to show a visual representation of Linked data and how this might interact with a users social media.

Additional idea...

The size of story nodes to be determined by the number of recorded tweets? - Can we use sharetool to pull this data for a story
The story nodes to have a tooltip containing the story headline...
The nodes for a followed twitter user to have a tooltip of containing the tweets in question..

Logic for mashing the data..

1. Collect interests from user
2. Push interests as FDG nodes into Json
3. Use Juicer API to determine stories..
4. Push stories as FDG nodes into Json - along with story headline and/or total number of Social media shares
5. Push links from stories back interests into Json - along with link type
6. Use Twitter API to collect users who have tweeted on stories
7. Push twitter_users as FDG nodes into Json - along with tweet
8. Push Links from twitter_users back to stories into Json - along with link type
9. Render FDG

Addition notes...

1. Nodes will be unique so by using an array we can make sure we link to any pre-existing node by using indexOf checks..
2. It will work best with interests which have some similarities i.e. Technology and Gadgets, as it will be far more likely to show links from different stories to single twitter_users


Challenges...

1. Mashing the data quickly, so the experience feels dynamic
2. Visual impact will be key, layout is taken care of by the FDG.

