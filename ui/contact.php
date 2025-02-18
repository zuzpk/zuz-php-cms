<?php 
use \Zuz\Config;
use \Zuz\User;

// if ( User::isGuest() ){ header("location: " . Config::BASEURL . "u/login?" . time()); exit; }
$you = User::Session(false);
?>
<div class="contact blurify rel">
    <h2 class="s50 b900 ptitle">Let's discuss your future product</h2>
    <h2 class="s24">Here's how we can find the best way to get it off the ground</h2>
    
    <div class="blocks flex aic">    
        <div class="block flex rel s20">    
            Shoot over an NDA if necessary, and share your app's main concept. A couple of sentences should do the trick!
            <svg class="abs" width="76" height="81" viewBox="0 0 76 81" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="6.10352e-05" y="6.7408" width="68.0199" height="74.1219" rx="6" fill="#EEEBFF"></rect>
                <rect x="8.03299" y="0.500008" width="67.0199" height="73.1219" rx="5.5" stroke="#5C3BFE"></rect>
                <path d="M22.5448 17.4359H55.8856" stroke="#5C3BFE" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M22.5448 30.2775H55.8856" stroke="#5C3BFE" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M22.5448 42.692H48.016" stroke="#5C3BFE" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </div>
        <div class="block flex rel s20">    
            Feel free to provide any documents, wireframes, or other materials you have.
            <svg class="abs" width="121" height="122" viewBox="0 0 121 122" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M15.4359 51.1703C18.9434 47.5031 27.5891 49.4468 33.4848 50.0068C35.9401 50.2344 39.6304 50.4241 43.7 50.0068C47.8389 49.5921 50.5694 46.0139 51.7039 44.5772C57.3635 37.4941 64.8272 30.6477 73.3915 29.3919C76.062 29.0224 85.5868 23.4894 98.4753 33.6974C102.585 36.9809 104.46 44.5268 105.96 48.6193C106.642 50.1921 107.089 51.7897 107.217 53.3415C107.931 57.7742 107.397 62.1594 105.681 66.1636C103.14 72.087 99.4431 77.4284 94.6387 81.6181C84.6049 90.4185 71.1506 95.6253 55.6908 94.8708C46.2071 94.4102 27.3695 91.4651 18.7644 85.1862C7.75669 77.1683 7.50165 59.3441 15.4359 51.1703Z" fill="#EEEBFF"></path>
              <path d="M22.4413 64.353V54.9745H53.9509M53.9509 64.353V54.9745M53.9509 54.9745H84.6376V64.353M53.9509 54.9745V46.3302" stroke="#5C3BFE" stroke-linecap="round" stroke-linejoin="round"></path>
              <path d="M22.4379 15.167H53.536M84.6341 15.167H53.536M53.536 15.167V27.1326" stroke="#5C3BFE" stroke-linecap="round" stroke-linejoin="round"></path>
              <circle cx="22.4449" cy="74.2086" r="9.31583" stroke="#5C3BFE"></circle>
              <circle cx="54.6214" cy="74.2086" r="9.31583" stroke="#5C3BFE"></circle>
              <circle cx="84.6342" cy="74.2086" r="9.31583" stroke="#5C3BFE"></circle>
              <rect x="22.9413" y="27.5065" width="61.1962" height="18.6317" rx="9.31583" stroke="#5C3BFE"></rect>
            </svg>
        </div>
    </div>
    <div class="blocks flex">    
        <div class="block flex rel s20">    
            Let us in on your schedule for a voice chat. When's good for you? Just give us date and time.
            <svg class="abs" width="84" height="84" viewBox="0 0 84 84" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M75.1188 43.9689C75.1188 46.4519 74.8462 49.004 74.303 51.6238C77.0231 55.1626 78.3836 59.1427 78.3845 63.5648C78.3845 68.9746 76.4712 73.5928 72.6432 77.4208C68.8177 81.2475 64.1983 83.162 58.7897 83.162C54.3665 83.162 50.3862 81.8004 46.8489 79.0783C44.2278 79.6227 41.6759 79.8955 39.1926 79.8955C34.3275 79.8955 29.675 78.9516 25.235 77.0633C20.7954 75.1745 16.9678 72.6237 13.7527 69.4088C10.5373 66.193 7.98555 62.3658 6.09766 57.9261C4.20959 53.4858 3.26583 48.8335 3.26583 43.9689C3.26583 41.4855 3.53823 38.9334 4.08233 36.3139C1.36095 32.7757 0 28.795 0 24.3722C0 18.9629 1.91327 14.3447 5.74125 10.5167C9.56886 6.68984 14.1871 4.77639 19.5962 4.77639C24.019 4.77639 27.9997 6.13734 31.5379 8.85907C34.1576 8.31462 36.7095 8.04221 39.1929 8.04221C44.0587 8.04221 48.7098 8.98669 53.1507 10.874C57.5905 12.7627 61.417 15.3142 64.6321 18.5295C67.8472 21.7447 70.3989 25.5718 72.2868 30.0114C74.1758 34.4514 75.1188 39.1039 75.1188 43.9689Z" fill="#EEEBFF"></path>
              <mask id="path-2-inside-1" fill="white">
                <path d="M79.2875 46.8474C79.8307 44.2275 80.1032 41.6755 80.1032 39.1925C80.1032 34.3275 79.1602 29.675 77.2712 25.235C75.3833 20.7953 72.8316 16.9683 69.6165 13.753C66.4015 10.5378 62.5749 7.98623 58.1351 6.09763C53.6942 4.21027 49.0431 3.26579 44.1774 3.26579C41.6939 3.26579 39.142 3.5382 36.5223 4.08265C32.9841 1.36092 29.0035 -3.05176e-05 24.5806 -3.05176e-05C19.1715 -3.05176e-05 14.5533 1.91342 10.7257 5.74032C6.89771 9.56829 4.98444 14.1865 4.98444 19.5958C4.98444 24.0186 6.34539 27.9992 9.06676 31.5375C8.52267 34.157 8.25026 36.7091 8.25026 39.1925C8.25026 44.057 9.19403 48.7094 11.0821 53.1497C12.97 57.5893 15.5217 61.4166 18.7371 64.6324C21.9522 67.8473 25.7798 70.3981 30.2195 72.2869C34.6595 74.1751 39.312 75.1191 44.177 75.1191C46.6603 75.1191 49.2122 74.8463 51.8333 74.3019C55.3707 77.0239 59.3509 78.3856 63.7741 78.3856C69.1827 78.3856 73.8022 76.4711 77.6276 72.6444C81.4556 68.8164 83.3689 64.1982 83.3689 58.7884C83.368 54.3662 82.0076 50.3862 79.2875 46.8474ZM63.1598 54.4256C62.038 56.4161 60.5319 58.0064 58.6442 59.1973C56.7554 60.3883 54.6718 61.2972 52.3926 61.9273C50.1134 62.5561 47.7322 62.8716 45.248 62.8716C39.4991 62.8716 34.5493 61.7571 30.3984 59.5282C26.2474 57.2991 24.1722 54.6211 24.1722 51.4904C24.1722 49.96 24.6062 48.6854 25.4738 47.6639C26.3413 46.6429 27.6255 46.1335 29.3266 46.1335C30.3133 46.1335 31.2315 46.4055 32.082 46.9493C32.9324 47.4937 33.7148 48.1495 34.4296 48.9153C35.1444 49.6812 35.9178 50.4457 36.7515 51.2116C37.5846 51.9775 38.6903 52.6319 40.0681 53.1763C41.4462 53.7208 43.0027 53.9936 44.7383 53.9936C46.9495 53.9936 48.735 53.5605 50.0972 52.6932C51.4574 51.8247 52.1377 50.7272 52.1377 49.4011C52.1377 48.0394 51.594 47.0192 50.5058 46.3389C49.7583 45.8611 47.8522 45.2489 44.7901 44.5008L37.3386 42.6627C35.2976 42.1868 33.5453 41.6345 32.0821 41.0055C30.619 40.3756 29.258 39.5516 27.9995 38.5301C26.7413 37.5098 25.7886 36.2259 25.1421 34.6773C24.4957 33.1297 24.1726 31.3176 24.1726 29.2424C24.1726 26.7586 24.7426 24.5735 25.8819 22.6847C27.0212 20.7962 28.5361 19.3161 30.4236 18.2445C32.3115 17.1728 34.3443 16.3734 36.5221 15.8461C38.6991 15.3186 40.9446 15.055 43.2581 15.055C46.5248 15.055 49.6194 15.4464 52.5458 16.2288C55.4715 17.0112 57.887 18.1594 59.7917 19.6734C61.6966 21.1879 62.6489 22.8804 62.6489 24.7513C62.6489 26.2817 62.1651 27.5921 61.1943 28.6804C60.2266 29.7686 58.942 30.3131 57.3424 30.3131C56.458 30.3131 55.6418 30.1088 54.8932 29.7005C54.145 29.2925 53.4651 28.7993 52.8514 28.2209C52.2391 27.6428 51.5918 27.0728 50.9117 26.5116C50.2314 25.9503 49.3127 25.4656 48.1573 25.0573C46.9992 24.6491 45.6903 24.4448 44.2274 24.4448C39.3288 24.4448 36.8789 25.7537 36.8789 28.3739C36.8789 28.952 37.0067 29.4624 37.2616 29.9047C37.5167 30.3469 37.7978 30.7042 38.1035 30.9764C38.409 31.249 38.9195 31.5209 39.6342 31.7933C40.349 32.0658 40.9444 32.2619 41.4206 32.3803C41.8966 32.4993 42.6457 32.6779 43.666 32.9158L48.9736 34.1403C50.6404 34.515 52.1281 34.9064 53.4388 35.3141C54.7492 35.7231 56.1523 36.301 57.6491 37.0497C59.1459 37.7981 60.3876 38.6313 61.3738 39.55C62.361 40.4695 63.1857 41.6335 63.8499 43.0453C64.5137 44.4576 64.8444 46.0143 64.8444 47.7148C64.8443 50.1983 64.2839 52.4356 63.1598 54.4256Z"></path>
              </mask>
              <path d="M79.2875 46.8474C79.8307 44.2275 80.1032 41.6755 80.1032 39.1925C80.1032 34.3275 79.1602 29.675 77.2712 25.235C75.3833 20.7953 72.8316 16.9683 69.6165 13.753C66.4015 10.5378 62.5749 7.98623 58.1351 6.09763C53.6942 4.21027 49.0431 3.26579 44.1774 3.26579C41.6939 3.26579 39.142 3.5382 36.5223 4.08265C32.9841 1.36092 29.0035 -3.05176e-05 24.5806 -3.05176e-05C19.1715 -3.05176e-05 14.5533 1.91342 10.7257 5.74032C6.89771 9.56829 4.98444 14.1865 4.98444 19.5958C4.98444 24.0186 6.34539 27.9992 9.06676 31.5375C8.52267 34.157 8.25026 36.7091 8.25026 39.1925C8.25026 44.057 9.19403 48.7094 11.0821 53.1497C12.97 57.5893 15.5217 61.4166 18.7371 64.6324C21.9522 67.8473 25.7798 70.3981 30.2195 72.2869C34.6595 74.1751 39.312 75.1191 44.177 75.1191C46.6603 75.1191 49.2122 74.8463 51.8333 74.3019C55.3707 77.0239 59.3509 78.3856 63.7741 78.3856C69.1827 78.3856 73.8022 76.4711 77.6276 72.6444C81.4556 68.8164 83.3689 64.1982 83.3689 58.7884C83.368 54.3662 82.0076 50.3862 79.2875 46.8474ZM63.1598 54.4256C62.038 56.4161 60.5319 58.0064 58.6442 59.1973C56.7554 60.3883 54.6718 61.2972 52.3926 61.9273C50.1134 62.5561 47.7322 62.8716 45.248 62.8716C39.4991 62.8716 34.5493 61.7571 30.3984 59.5282C26.2474 57.2991 24.1722 54.6211 24.1722 51.4904C24.1722 49.96 24.6062 48.6854 25.4738 47.6639C26.3413 46.6429 27.6255 46.1335 29.3266 46.1335C30.3133 46.1335 31.2315 46.4055 32.082 46.9493C32.9324 47.4937 33.7148 48.1495 34.4296 48.9153C35.1444 49.6812 35.9178 50.4457 36.7515 51.2116C37.5846 51.9775 38.6903 52.6319 40.0681 53.1763C41.4462 53.7208 43.0027 53.9936 44.7383 53.9936C46.9495 53.9936 48.735 53.5605 50.0972 52.6932C51.4574 51.8247 52.1377 50.7272 52.1377 49.4011C52.1377 48.0394 51.594 47.0192 50.5058 46.3389C49.7583 45.8611 47.8522 45.2489 44.7901 44.5008L37.3386 42.6627C35.2976 42.1868 33.5453 41.6345 32.0821 41.0055C30.619 40.3756 29.258 39.5516 27.9995 38.5301C26.7413 37.5098 25.7886 36.2259 25.1421 34.6773C24.4957 33.1297 24.1726 31.3176 24.1726 29.2424C24.1726 26.7586 24.7426 24.5735 25.8819 22.6847C27.0212 20.7962 28.5361 19.3161 30.4236 18.2445C32.3115 17.1728 34.3443 16.3734 36.5221 15.8461C38.6991 15.3186 40.9446 15.055 43.2581 15.055C46.5248 15.055 49.6194 15.4464 52.5458 16.2288C55.4715 17.0112 57.887 18.1594 59.7917 19.6734C61.6966 21.1879 62.6489 22.8804 62.6489 24.7513C62.6489 26.2817 62.1651 27.5921 61.1943 28.6804C60.2266 29.7686 58.942 30.3131 57.3424 30.3131C56.458 30.3131 55.6418 30.1088 54.8932 29.7005C54.145 29.2925 53.4651 28.7993 52.8514 28.2209C52.2391 27.6428 51.5918 27.0728 50.9117 26.5116C50.2314 25.9503 49.3127 25.4656 48.1573 25.0573C46.9992 24.6491 45.6903 24.4448 44.2274 24.4448C39.3288 24.4448 36.8789 25.7537 36.8789 28.3739C36.8789 28.952 37.0067 29.4624 37.2616 29.9047C37.5167 30.3469 37.7978 30.7042 38.1035 30.9764C38.409 31.249 38.9195 31.5209 39.6342 31.7933C40.349 32.0658 40.9444 32.2619 41.4206 32.3803C41.8966 32.4993 42.6457 32.6779 43.666 32.9158L48.9736 34.1403C50.6404 34.515 52.1281 34.9064 53.4388 35.3141C54.7492 35.7231 56.1523 36.301 57.6491 37.0497C59.1459 37.7981 60.3876 38.6313 61.3738 39.55C62.361 40.4695 63.1857 41.6335 63.8499 43.0453C64.5137 44.4576 64.8444 46.0143 64.8444 47.7148C64.8443 50.1983 64.2839 52.4356 63.1598 54.4256Z" stroke="#5C3BFE" stroke-width="2" mask="url(#path-2-inside-1)"></path>
            </svg>
        </div>
        <div class="block flex rel s20">    
            We'll share time and budget estimates within 24-48 hours after our intro.
            <svg class="abs" width="107" height="104" viewBox="0 0 107 104" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M47.1352 11.8848C48.0333 9.12083 51.9435 9.12083 52.8415 11.8848L60.5379 35.5718C60.9395 36.8079 62.0914 37.6447 63.3911 37.6447H88.2971C91.2033 37.6447 92.4116 41.3636 90.0605 43.0718L69.9111 57.7112C68.8596 58.4751 68.4196 59.8292 68.8213 61.0653L76.5176 84.7523C77.4157 87.5162 74.2523 89.8146 71.9011 88.1064L51.7517 73.467C50.7003 72.7031 49.2765 72.7031 48.225 73.467L28.0756 88.1064C25.7245 89.8146 22.5611 87.5162 23.4591 84.7523L31.1555 61.0653C31.5571 59.8292 31.1171 58.4751 30.0657 57.7112L9.9163 43.0718C7.56516 41.3636 8.77349 37.6447 11.6797 37.6447H36.5857C37.8853 37.6447 39.0372 36.8079 39.4388 35.5718L47.1352 11.8848Z" fill="#EEEBFF"></path>
              <path d="M53.7064 8.93569C54.4548 6.63241 57.7133 6.63241 58.4617 8.93569L66.1581 32.6227C66.6267 34.0648 67.9705 35.0411 69.4868 35.0411H94.3928C96.8146 35.0411 97.8216 38.1402 95.8623 39.5637L75.7129 54.2031C74.4862 55.0943 73.9729 56.6741 74.4414 58.1162L82.1378 81.8032C82.8862 84.1065 80.25 86.0218 78.2907 84.5983L58.1413 69.9589C56.9146 69.0677 55.2535 69.0677 54.0268 69.9589L33.8774 84.5983C31.9182 86.0218 29.282 84.1065 30.0303 81.8032L37.7267 58.1162C38.1953 56.6741 37.682 55.0943 36.4553 54.2031L16.3059 39.5637C14.3466 38.1402 15.3535 35.0411 17.7754 35.0411H42.6814C44.1977 35.0411 45.5415 34.0648 46.0101 32.6227L53.7064 8.93569Z" stroke="#5C3BFE"></path>
            </svg>
        </div>
    </div>

    <div class="blocks flex">    
        <div class="block flex col rel s20">    
            
            <p class="para font s20">Got a question? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
            <p class="para font s20">Fill in details and hit `Submit` and we will get back to you in no time :)</p>
            
            <div class="cover abs fill flex aic jc">
                <div class="loading rel flex aic jc"></div>
            </div>
            
            <div class="uform flex col rel" style="margin-top: 20px;">
                
                <input type="text" style="margin-bottom: 20px;" value="<?php if($you->sess){ echo $you->nm; } ?>" autocomplete="new-password" placeholder="Enter your name." class="input _fullname s18" />
                <input type="text" style="margin-bottom: 20px;"value="<?php if($you->sess){ echo $you->em; } ?>" autocomplete="new-password" placeholder="Enter your email." class="input _email s18" />
                <input type="text" style="margin-bottom: 20px;" autocomplete="new-password" placeholder="Enter your subject." class="input _subject s18" />
                <textarea style="margin-bottom: 20px;height: 200px;" placeholder="Enter your message." class="input _message s18"></textarea>
                <button class="bold buton s18 submit-feedback">Submit</button>

            </div>


        </div>
        <div class="block flex col rel s24">    

            <h2 class="s18 b900" style="margin-bottom: 10px;">General Questions</h2>
            <h2 class="s18"><?php echo Config::PUBLIC_EMAIL_ACCOUNT; ?></h2>
            
            <h2 class="s18 b900" style="margin: 20px 0px 10px 0px;">Address</h2>
            <h2 class="s18"><?php echo Config::PUBLIC_ADDRESS; ?></h2>

            <h2 class="s18 b900" style="margin: 20px 0px 10px 0px;">Meet us</h2>
            <a href="/team" class="s18 tdn tdnh c111 flex ass">Our Team</a>
            <a href="/help/about" class="s18 tdn c111 tdnh flex ass">About Us</a>
            <a href="/help/tos" class="s18 tdn tdnh c111 flex ass">Terms of Service</a>
            <a href="/help/privacy" class="s18 tdn tdnh c111 flex ass">Privacy Policy</a>

        </div>
    </div>



</div>
<style>body{background: #f6f7f9;}.footer .area{background: #fff;}</style>
<script>document.title = `Contact us`;</script>