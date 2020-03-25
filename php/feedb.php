<?php


if($sentimentScore < -.25 )
{
    echo "You addressed a lot of the negatives in your journal. Now think about the positives! What are interactions and things that you enjoyed today?";
}
else if($sentimentScore >= -.25 and $sentimentScore <= .25)
{
    echo "You seem to show conflicting thoughts. Take time to analyze and acknowledge the positives and negatives of your day.";
}
else
{
    echo "You are on the right track! Keep up the great and positive energy!";
}

if($prevSentimentScore < $sentimentScore)
{
    echo "I see you have been making progress! Remember to take time out of your day for self-healing (i.e. exercising, taking walks, yoga)";
}
else
{
    echo "You have been showing too much negative thoughts lately. Remember to take time out of your day for self-healing (i.e. exercising, taking walks, yoga)". 
}

?>
