<p>
Google analytics is a reference tool. Google analytics is not to track every single visit.
No counter can track 100% of the traffic. The best counter should be the counter implemented on the same server.
Another good place to track traffic is the raw log of the website.
</p>

<p>
Google Analytics is an unreliable tool to track our traffic. You can track our traffic with our own statistics. Tools like www.statcounter.com or www.extremetracking.com will also give a good statistical information. 
</p>

<!--

<td colspan="3" height="10" valign="top">&nbsp;</td>
        </tr>
      
      <tr>
          <td colspan="3" height="100%" valign="top" width="13680"> 
            <table border="1" bordercolor="#000000" cellpadding="0" cellspacing="0" height="97%" width="99%">

              <tbody><tr> 
                <td height="100%" valign="top" width="100%"> <table align="center" border="0" cellpadding="0" cellspacing="0" height="100" width="98%">
                    <tbody><tr> 
                      <td height="100%" valign="top" width="42%"> <div align="center"> 
                          <table border="0" cellpadding="0" cellspacing="12" width="100%">
                            <tbody><tr>
                              <td valign="top"><div align="center">
                                  <br> 
                                  <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tbody><tr>

                                      <td align="left"><strong class="texttitle style4"><font face="Arial, Helvetica, sans-serif">How to track our traffic </font></strong><br>
                                        <br>
                                        <span class="textnormal"><em></em><br>
                                        
                                            There are many reasons that incorrect tracking can happen,  I have put together this page to explain  why it's happening and make suggestions on how to fix this so you can correctly track our traffic using a third party counter. I hope this helps you  to understand how our redirection process works and better interpret your stats. <br>

                                            
                                        </span><span class="texttitleorange"><br>
                                        Step 1: How our redirection process works</span><span class="textnormal"><br>
                                        <br>
                                        In order to understand why your counter may not track our visitors properly, you need to understand how our traffic redirection process works. <br>
                                        <br>

                                        Basically, our traffic comes from a large network of specialized websites that receive thousands of visitors every day; we collect this traffic and, using a proprietary algorithm, deliver it to our customers’ websites through our main traffic server. <br>
                                        <br>
                                        The redirection process consists of three separate steps: <br>
                                        <br>
                                        </span>
                                        <table align="center" border="0" width="90%">
                                          <tbody><tr>
                                            <td><span class="textnormal"><strong>1.</strong> A visitor visits one of the sites in our advertising network (we have thousands of different sites) <br>

                                              <br>
                                                  <strong>2.</strong> The website of a customer is loaded through our traffic network in a separate window, based on the requirements of that traffic campaign <br>
<br>
<strong>3.</strong> The input of this visit is sent back to our traffic server (instantly) and to the website third party counter (if any). </span></td>
                                          </tr>
                                        </tbody></table>
                                        
-->                                        

                                        
                                        <p align="left"><span class="textnormal"><br>
                                       
                                          <br>
                                          <span class="texttitleorange">Step 2: Our internal tracker</span><br>
                                          <br>
                                          <span class="textnormal">In order to track our traffic we developed an internal counter that resides on the same traffic server that handles your campaign. We designed it this way to minimize the delay between the time your website is shown in our advertising network and the time that the visit is counted. <br>
                                          <br>
                                          Every time your site is shown in the network, our internal counter tracks it and shows it as a visit. Thanks to this server architecture, our counter never advances unless your site is visited through the server. In other words, the hit count is incremented at the same exact time a visitor is sent to your site. To make sure that our internal counter only tracks visits being redirected from our advertising network, we assign each campaign a unique URL that is strictly connected to the counter. </span><br>
                                          <br>

                                        </p>
                                        
                                        <p class="textnormal" align="left"><br>
                                          







                                          
                                          <span class="texttitleorange">Step 3: Third party stats, why they may not work properly with our traffic</span><br>
                                          <br>
                                          There are an enormous amount of counters out there and each one works slightly different from the others. Thus, there may be lots of reasons why a specific tracker doesn’t count our traffic properly. Here’s a list of the most common issues that we’ve experienced using third party counters with our traffic.<br>
                                          <br>
                                          <span class="texttitle"><span class="style4">1.</span> <span class="style6">missing traffic in the redirection process</span></span><br>

                                          <br>
                                          When we redirect a large number of visitors from our network to your site passing through our traffic server, there are chances that a small portion of this traffic will be lost and never tracked. While this number is extremely low using our counter (it is installed on the same server that redirect the visitors to your site), it may be higher with third party stats and even raw server logs. As an example, imagine a camera on a highway: if there isn’t much traffic, a car or two per second, the camera will have no difficulties in keeping track of each car. However, when traffic is very high and at very high speed, say 10 cars per second in each lane, the camera will have a hard time counting all the cars that pass by, and will surely miss some. That said, it is important to understand that, even if some of our visitors are not counted, they have been  successfully redirected to your website: not being tracked by the camera doesn't mean that a car hasn't passed by. <br>
                                          <br>
                                          <span class="texttitle style6"><span class="style4">2.</span> separate server tracking</span><br>
                                        <br>
                                        When you use a third party stat counter, you will be asked to add a small portion of html code in the pages of your website. This is how they track a visitor that visited that page. In order for the third party counter to track a visitor, an input is sent from your site to the tracker server. In other words, your site is telling the tracker server, through that code, that a visitor actually visited your page. Unfortunately, this input relies on multiple factors including the connection speed of your website, the connection speed of the tracker server and its response time. Even if in the vast majority of cases a visit is correctly tracked, it may happen that, when there are multiple visits being sent in a very short timeframe, the tracker server  misses some of the inputs being sent by the code on your site and this results in a wrong traffic count.</p>

                                        <p class="textnormal"><span class="texttitle style6"><span class="style4">3.</span> load time </span><br>
                                          <br>
                                          Load time is the time needed to load your page, and may vary between a few milliseconds to a few seconds. Given the way our traffic server works, we do not need a website to fully load to track it in our system. As soon as the site is shown in our network, we count it as a visit. Instead, third party counters may take more time to count the visit or need to load the page completely in order to load the counter code and register that visit as a hit. We cannot control the behavior of the end users, or force them to stay on the site a certain length of time. If they choose to 'close out' prior to your counter load, it is still considered a delivered visitor by us, but the third party counter may not record it. <br>
                                          <br>
                                          <span class="texttitle style6"><span class="style4">4.</span> filters</span><br>

  <br>
  Many third party counters have filters in place to recognize visits that have specific characteristics, and show them only once or even block them from being recorded. 
  It can lower the count than actual traffic sent. 
  
  <!--cBased on the way our traffic server works, we redirect people from just one URL (the URL of our traffic server, through which visitors are redirected from the advertising network to your website) and  redirect many visitors within a very short timeframe (i.e. 10 visitors every second). Third party counters may filter this traffic and prevent it from being showed in the total visitor count. Here’s an example: we redirect 20 visitors from 20 different pages in our advertising network to your website within 10 seconds. Actually, you have  received 20 potential leads that are not connected to each other whatsoever (each one comes from a different site in our network). Anyway, a regular third party counter will record these visitors as coming from the same site (traffic.onlineservicescloud.com, our traffic server) within a very short timeframe (10 seconds) and it is most likely to show these 20 visitors as just ONE visitor (same site, short timeframe). Thus, 19 real visitors were missed by the third party counter because it wrongly filtered them.--> <br>
                                          <br>
                                          <span class="texttitle style6"><span class="style4">5.</span> real time update</span><br>
                                          <br>
                                          When we show you site in our network, we immediately track it and show it as a visit in our internal counter. This is done in real time. Anyway, many third party counters (especially Google Analytics) are not updated in real time and experience a delay between the time a visitor is recorded and the time it's showed in the logs. Please make sure to wait at least 12 hours before comparing our and third party stats. <br>

                                          <br>
                                          <span class="texttitle style6"><span class="style4">6.</span> tracker downtime</span><br>
                                          <br> 
                                          Third party counters, and particularly the free ones, often experience downtime during peak periods and do not count traffic received during that timeframe.<br>
                                          <br>
                                          <span class="texttitle style6"><span class="style4">7.</span> many more</span><br>

                                        <br>
                                        There may be many more  reasons  a specific third party counter does not count our traffic, including both counter issues (javascripts, IP filtering, counting algorithms) and user  issues. Please keep on reading to learn more about a third party tracker that works with our traffic. <br>
                                          <br>
                                        </p>
                                                                                <p class="textnormal"><br>
                                          <img src="images/home_spacer.gif" height="2" width="752"><br>
                                          <br>
                                          <br>
                                          <span class="texttitleorange">Step 4: A third party counter that works</span>
                                          
 