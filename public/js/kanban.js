new jKanban({
    element: '#kanban',
    gutter: '40px',
    click: function (el) {
        alert(el.innerHTML);
    },
    boards: [
        {
            'id': '_new',
            'title': 'Новые',
            'class': 'success',
            'dragTo': ['_working'],
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
            'class': 'warning',
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
            'class': 'warning',
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
            'class': 'warning',
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
            'class': 'success',
            'dragTo': ['_working'],
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