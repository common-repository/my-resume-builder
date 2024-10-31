jQuery(document).ready(function ($) {

    $(function(){
        
        $("#btn_download").click(function(){
            const element = document.getElementById('resume_box');
            var opt = {
                margin:       1,
                filename:     'myResume.pdf',
                image:        { type: 'jpeg', quality: 0.99 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'mm', format: [198, 217], orientation: 'portrait' }
            };
            
            //html2pdf().set(opt).from(element).save()
            //html2pdf(element)

            var doc = new jsPDF();
            var elementHTML = $('#main').html();
            // var specialElementHandlers = {
            //     '#elementH': function (element, renderer) {
            //         return true;
            //     }
            // };
            doc.fromHTML(elementHTML, 5, 5, {
                'width': 100,
                // 'elementHandlers': specialElementHandlers
            },
            function(bla){doc.save('saveInCallback.pdf');},
            );

            // Save the PDF
            //doc.save('sample-document.pdf');
        })
    })


})