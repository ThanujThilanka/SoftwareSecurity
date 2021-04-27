export const fetchData = async (url, filter) => {

    const tokenString = localStorage.getItem("user-info")

    const token = JSON.parse(tokenString).token

    let result = await fetch(url + filter, {
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + token,
            "Content-Type": 'application/json',
            "Accept": 'application/json'
        },
    });
    result = await result.json();
    return result.original

}