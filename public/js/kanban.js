new jKanban({
    element: '#kanban',
    gutter: '15px',
    widthBoard: '100%',
    responsivePercentage: true,
    click: function (el) {
        alert(el.innerHTML);
    },
    boards: [
        {
            'id': '_new',
            'title': 'Новые',
            'class': 'bg-primary,text-white',
            'dragTo': ['_working_dtf', '_working_UV', '_working_printing', '_ship'],
            'item': [
                {
                    'title': 'My Task Test',
                },
                {
                    'title': 'Buy Milk',
                }
            ]
        },
        {
            'id': '_working_dtf',
            'title': 'В работе (DTF)',
            'class': 'bg-warning,text-white',
            'item': [
                {
                    'title': 'Do Something!',
                },
                {
                    'title': 'Run?',
                }
            ]
        },
        {
            'id': '_working_UV',
            'title': 'В работе (UV)',
            'class': 'bg-warning,text-white',
            'item': [
                {
                    'title': 'Do Something!',
                },
                {
                    'title': 'Run?',
                }
            ]
        },
        {
            'id': '_working_printing',
            'title': 'В работе (Нанесение)',
            'class': 'bg-warning,text-white',
            'item': [
                {
                    'title': 'Do Something!',
                },
                {
                    'title': 'Run?',
                }
            ]
        },
        {
            'id': '_ship',
            'title': 'К отправке',
            'class': 'bg-success,text-white',
            'item': [
                {
                    'title': 'All right',
                },
                {
                    'title': 'Ok!',
                }
            ]
        }
    ]
});