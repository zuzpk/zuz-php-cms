(function () {

  let App = {
    editName: null,
    editType: null,
    editContact: null,
    editSchedule: null,
    deleteContact: null,
  }
  function editBillingInfo() {
    let data = {}
    $(`.info .edit-info`).find('input').each((__, _) => {
      if ($(_).attr('name')) data[$(_).attr('name')] = $(_).val().trim();
    })
    data.country = $(`.info .edit-info select`)[0].value

    function selFocus(n) {
      $(`.info .edit-info [name=${n}]`).focus();
    }

    let { address, city, company, country, postal_code, state, vat } = data
    if (!address) {
      Toast.show('Enter a valid address', 4, `error`);
      selFocus('address')
    } else if (!city) {
      Toast.show('Enter a valid city', 4, `error`);
      selFocus('city')
    } else if (!company) {
      Toast.show('Enter a valid company name', 4, `error`);
      selFocus('company')
    } else if (!country) {
      Toast.show('Select country', 4, `error`);
      selFocus('country')
    } else if (!postal_code) {
      Toast.show('Enter a valid postal code', 4, `error`);
      selFocus('postal_code')
    } else if (!state) {
      Toast.show('Enter a valid state', 4, `error`);
      selFocus('state')
    } else {
      console.log(data)
    }

  }
  
  function Contact() {
    // function getData(cls) {
    //   let data = {};
    //   $(cls).find('input').each((__, _) => {
    //     if ($(_).attr('name')) data[$(_).attr('name')] = $(_).val().trim();
    //   })
    //   data.type = $(`${cls} .choosen`).attr('data-value');
    //   return data;
    // }
    function validate(cls) {

      function selFocus(n) {
        $(`.in-page.report-contact .add-contact-form .add-contact-query [name=${n}]`).focus();
      }

      let data = {};
      $(cls).find('input').each((__, _) => {
        if ($(_).attr('name')) data[$(_).attr('name')] = $(_).val().trim();
      })

      data.type = $(`${cls} .choosen`).attr('data-value');
      const { name, value, type } = data;
      if (App.editContact === null) {
        if (!name || name == '' || /^(?![A-Za-z]+$)/.test(name)) {
          Toast.show('Enter Contact Name', 4);
          selFocus('name');
        } else if (!value || value == '') {
          Toast.show('Enter Contact Value', 4);
          selFocus('value');
        } else if (type.toLowerCase() === 'pause' || type == '') {
          Toast.show('Select Contact Type', 4);
          selFocus('value');
        } else if (
          (type.toLowerCase() === 'sms' && /^(?![0-9]+$)/.test(value)) ||
          (type.toLowerCase() === 'email' && !isValidEmail(value))
        ) {
          Toast.show(`Enter your Contact ${type.toLowerCase() === 'sms' ? 'Phone Number' : 'Email Address'}`, 4);
          selFocus('type');
        } else {
          // request data
          console.log({name: name,value: value,type: type})
          cancelEdit();
        }
      } else {
        if (name === App.editName && value === App.editContact && type === App.editType) {
          Toast.show('No modifications detected.', 4);
        } else {
          console.log({ name: name, value: value, type: type })
          cancelEdit();
        }
      }

    }

    function cancelEdit() {
      $(`.report .pop-wraper`).hide();
      App.editContact = null;
      App.editName = null;
      App.editType = null;
    }

    function updateContact() {
      validate(`.in-page.report .report-form-popup .report-pop-m`);
    }

    function addContact() {
      validate(`.in-page.report .add-contact-form .contact-add-query`);
    }

    function cancelDelete() {
      App.deleteContact = null;
      $(`.in-page.report .pop-del-wraper`).hide();
    }

    $(document).on('click', `.in-page.report-contact .add-contact-form .add-new`, addContact);
    $(document).on('click', `.in-page.report-scheduled .add-contact-form .action-edit`, function () {
      // App.editSchedule = '';
      $(`.in-page.report-scheduled .add-contact-form`).show();
    })

    $(document).on('click', '.in-page.report-contact input[id="alert-hours"]', function () {
      $('.alert-duration').toggle($(this).prop('checked')).filter(':visible').css('display', 'flex');
    });

    $(document).on('click', '.in-page.report-contact .dt-row .action-edit', function () {
      $(`.in-page.report .pop-wraper`).show().css('display', 'flex')
      const data = $($(this).closest('.dt-row'));
      App.editName = data.find('.dt-name').html();
      App.editType = data.find('.dt-type h1').html();
      App.editContact = data.find('.dt-contact h1').text();
      $('.report .report-pop-m [name="name"]').val(App.editName)
      $('.report .report-pop-m [name="value"]').val(App.editContact)
      $('.report .report-pop-m [name="type"]').attr('data-value', App.editType).find('button .lbl').text(App.editType)

    });

    $(document).on('click', '.report .report-form-popup .report-pop-hed .times', cancelEdit)
    $(document).on('click', '.report.report-contact .action-not', cancelDelete)
    $(document).on('click', '.report.report-contact .dt-row .action-delete', function () {
      App.deleteContact = $($(this).closest('.dt-row')).find('.dt-contact h1').text();
      $(`.in-page.report .pop-del-wraper`)
        .show().css('display', 'flex');
      console.log(App.deleteContact)
    });
    $(document).on('click', '.report.report-contact .action-cdelete', function () {
      // send the request
      console.log('ondel', App.deleteContact)
      cancelDelete();
    });
    $(document).on('click', '.in-page.report.report-contact > button.ups', function(){
      const day = $(`.in-page.report-contact .contact-alert .alerting-days .choosen`).attr('data-value'),
        check = $(`.in-page.report-contact .contact-alert .alerting-duration [type="checkbox"]`),
        from = $(`.in-page.report-contact .contact-alert .alerting-duration .choosen.from`).attr('data-value'),
        to = $(`.in-page.report-contact .contact-alert .alerting-duration .choosen.to`).attr('data-value');
        

    })
    $(document).on('click', '.report .report-form-popup .report-pop-fot .action-save', updateContact)
    $(document).on('click', '.report .report-form-popup .report-pop-fot .action-cancel', cancelEdit)
  }

  function initApp() {

    Contact();
    $('.tokenizer').tokenizer();
    $(document).on('click', '.info .edit-info .edit-billing-info', editBillingInfo)
    $(document).on('click', '.payment-method .method-add', function () {
      $(`.payment-method .con-info`).addClass(`v`)
      $(`.payment-method .con-info-bg`).fadeIn(200)
    });

    $(document).on('click', '.payment-method .close-con-info', function () {
      $(`.payment-method .con-info`).removeClass(`v`)
      $(`.payment-method .con-info-bg`).fadeOut(200)
    });


    // reports pages

    // $(document).on('click','.in-page.report-contact .action-edit',function(){
    //     if(App.editContact !== null) return Toast.show('Save changes first',4);
    //     App.editContact = $($(this).closest('.dt-row')).find('.dt-contact h1').text();
    //     $('.in-page.report-contact .add-contact-form [data-value="add"]')
    //       .html('Save').addClass('s16')
    //       .attr('data-value', 'save');
    // });

    // $(document).on('click',`.in-page.report-contact .add-contact-form .add-new`, contactRequest);
    // $(document).on('click',`.in-page.report-scheduled .add-contact-form .action-edit`,function(){
    //   App.editSchedule = '';
    //   $(`.in-page.report-scheduled .add-contact-form`).show();
    // })
  }

  $(document).ready(function () {
    initApp();
  })

})();



