<?php 

class TweetsController extends AppController { 
     
    var $name = 'Tweets'; 
	
    function index(){ 
       // $this->set('tweets', $this->paginate()); 
        $this->Twitter = ConnectionManager::getDataSource('twitter');

        $results = $this->Twitter->status_public_timeline(); 
        $results2 = $this->Twitter->status_friends_timeline('elvitorinterior'); 

		$this->set('results',$results); //$results
		$this->set('results2',$results2); //$results
    } 

    function search(){ 
        if(!empty($this->data['Tweet']['keyword'])){ 
            $this->Twitter = ConnectionManager::getDataSource('twitter'); 
            $search_results = $this->Twitter->search($this->data['Tweet']['keyword'], 'all', 5); 
            // let's loop through tweets 
            foreach($search_results['Feed']['Entry'] as $rawtweet){ 
                // format to our needs 
                $i = explode(' ', $rawtweet['Author']['name']); 
                $tweet['Tweet']['twitter_username'] = $i[0]; 
                $tweet['Tweet']['tweet_content'] = $rawtweet['content']['value']; 
                $tweet['Tweet']['created'] = date('Y-m-d H:i:s' , strtotime($rawtweet['published'])); 
                $tweet['Tweet']['updated'] = date('Y-m-d H:i:s' ,strtotime($rawtweet['updated'])); 
                // and save 
                                $this->Tweet->create();             
                $this->Tweet->save($tweet); 
            } 
            $this->Session->setFlash(__('Got tweets.', true)); 
        }     
    } 
} 
?> 
