function createDynamicLangChart(val)
	{
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("lang" +random, val,0);
		var url="functions_php/Lang.php?";
		var fName="lang";
		getData(url, id, fName);
	}

	function createDynamicSiteChart(val)
	{
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("site"+random, val,0);
		var url="functions_php/Site.php?";
		var fName="site";
		getData(url, id, fName);
	}


	function createDynamicTopWordsChart(val)
	{
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("words"+random, val,0);
		var url="functions_php/Topwords.php?";
		var fName="words";
		getData(url, id, fName);
	}

	function createDynamicSourceChart(val)
	{
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("source"+random, val,0);
		var url="functions_php/Source.php?";
		var fName="source";
		getData(url, id, fName);
	}

	
	function createDynamicSentimentChart(val)
	{
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("senti"+random, val,0);
		var url="functions_php/Sentiment.php?";
		var fName="sentiment";
		getData(url, id, fName);
	}
	
	function createDynamicPosts(val)
	{
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("posts" + random, val,0);
		var url="functions_php/Posts.php?"
		var fName="posts";
		getData(url, id, fName);
	}

	function createDynamicWordCloud(val)
	{
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("wordcloud" + random, val,0);
		var url="functions_php/WordCloud.php?"
		var fName="wordcloud";
		getData(url, id, fName);

	}