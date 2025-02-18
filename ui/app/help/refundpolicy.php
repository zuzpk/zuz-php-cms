<?php if($_PARAMS->section == "refund-request"){ ?>
<div class="header-tall contact rel flex aic " style="background: url(<?php echo THEME . 'images/graph-bg.svg?v=' . time(); ?>) no-repeat center;">
    <div class="sec a flex col">

        <h1 class="s50 b900">Refund Request</h1>
        <h1 class="s24">Please check our <a href="<?php echo BASEURL; ?>help/refund-policy">refund policy</a> before proceeding with the refund.<br />A refund can be issued only if the order meets its refund guarantee.</h1>
    
    </div>

    <div class="sec b flex col rel">

        <?php echo Cover('rgba(220, 229, 231, .87)'); ?>

        <h1 class="s16 b rrt">Email <span>*</span></h1>
        <input type="text" class="input s16" name="email" placeholder="Enter email address">

        <h1 class="s16 b rrt rrt">Product <span>*</span></h1>
        <select autocomplete="off" id="product" name="product_name" class="input product_name">
            <option value="">Please select a Package</option>
            <option value="person">Personal</option>
            <option value="Pro">Professional</option>
            <option value="team">Team</option>
            <option value="business">Small Business</option>
        </select>

        <h1 class="s16 b rrt rrt">Refund Reason <span>*</span></h1>
        <select autocomplete="off" id="refund_reason" name="refund_reason" class="input refund_reason">
            <option value="" selected="selected">Please select a reason</option>
            <option value="Still free / limited version">Still free / limited version</option>
            <option value="Didn't receive the product">Didn't receive the product</option>
            <option value="No longer needed">No longer needed</option>
            <option value="Duplicate orders">Duplicate orders</option>
            <option value="Unwanted auto renewal">Unwanted auto renewal</option>
            <option class="others" value="others">Others</option>
        </select>

        <button class="button s16 send-rr">Submit</button>
    
    </div>

</div>

<?php }else{ ?>

<div class="privacy flex col rel">

    <div class="header-tall small rel flex col aic jcc" style="background: url(<?php echo THEME . 'images/graph-bg.svg?v=' . time(); ?>) no-repeat center;">

        <h1 class="s50 b900">Refund Policy</h1>
        <h1 class="s36">We value every customer and strive to provide customers<br />with satisfied products and services.</h1>


        <div class="icon-chevron-down s30 chevron anim abs"></div>

    </div>

    <div class="ssec flex col aic">

    <h2 class="s20 font b ptitle">Cancel Subscriptions</h2><br>
    <p class="para font s16">
    Customers can cancel a subscription at any time. When canceling a subscription, all future charges associated with this subscription will be canceled. Customers may notify us of their intent to cancel at any time; your cancellation will become effective at the end of your current billing period. You will not receive a refund; however, your subscription access and/or delivery and accompanying subscriber benefits will continue for the remainder of the current billing period.
    </p>
    <h2 class="s20 font b ptitle">Full Money Back Guarantee</h2><br>
    <p class="para font s16">
    We provide a 7-days Full Money Back Guarantee for subscription plans, including all Personal, Professional, Team, and Small Business subscription plans.
    </p>
    <p class="para font s16">
    To ensure that all customers have enough time to evaluate whether the purchased product and service meet their needs, we provide full money back guarantee. Full refund request will be approved within the 7 Days if you have purchased a subscription for the first time,the subscription was purchased within the last 7 days, you are not satisfied. If a refund request is not submitted within the subscription's specified money-back-guarantee period, no full refund will be issued.
    </p>
    <h2 class="s20 font b ptitle">Other refunds</h2><br>
    <p class="para font s16">
    If a refund request due to technical trouble of the purchased product and service, and no solution has been provided within 7 days. In this case, we can pause the subscription to wait for future upgrade. This will pause future subscription payments for this payee until we manually resume the subscription. Or we can refund the left unused subscription month if the customer doesn't want to wait for a future upgrade. However, we hope customers can cooperate with our support team to troubleshoot the problem by providing detailed descriptions and information regarding the problem, and also applying the solutions provided by our support team.
    </p>
    <h2 class="s20 font b ptitle">How to cancel and refund</h2><br>
    <p class="para font s16">
    If customers want to cancel the subscription or request refund, please <a href="<?php echo BASEURL; ?>help/refund-request" class="b tdn tdnh">click here</a> to contact our support team to submit your request. Once a refund is issued, customers cannot use the product and service any more.
    </p>

    </div>  
    
</div>
<style>.para{margin: 6px 0px 25px 0px;}
<?php } ?>