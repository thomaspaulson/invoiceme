import axios from '../api/axios';
import { useEffect, useState } from 'react';

export default function Dashboard() {
    const [user, setUser] = useState(null);

    useEffect(() => {
        axios.get('/api/user')
            .then(res => setUser(res.data));
    }, []);

    return (
        <div className="p-10">
            <h1 className="text-2xl font-bold">
                Welcome {user?.name}
            </h1>
        </div>
    );
}
