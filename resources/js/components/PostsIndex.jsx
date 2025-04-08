import React, { useEffect, useState } from 'react';
import axios from 'axios';

const PostsIndex = () => {
    const [posts, setPosts] = useState([]);
    const [newComments, setNewComments] = useState({});
    const [loading, setLoading] = useState(true);

    // Configure axios with auth token
    const api = axios.create({
        baseURL: '/api',
        headers: {
            'Authorization': `Bearer ${localStorage.getItem('auth_token')}`
        }
    });

    const fetchPosts = async () => {
        try {
            const res = await api.get('/posts');
            setPosts(res.data);
        } catch (err) {
            console.error(err);
            if (err.response?.status === 401) {
                window.location.href = '/login';
            }
        } finally {
            setLoading(false);
        }
    };

    const handleReaction = async (postId, type) => {
        try {
            await api.post(`/posts/${postId}/react`, { type });
            fetchPosts(); // Refresh posts
        } catch (err) {
            console.error('Reaction error:', err);
        }
    };

    const handleCommentSubmit = async (postId) => {
        const commentText = newComments[postId];
        if (!commentText?.trim()) return;

        try {
            await api.post(`/posts/${postId}/comment`, { content: commentText });
            setNewComments(prev => ({ ...prev, [postId]: '' }));
            fetchPosts(); // Refresh posts
        } catch (err) {
            console.error('Comment error:', err);
        }
    };

    useEffect(() => {
        // First get CSRF cookie
        axios.get('/sanctum/csrf-cookie')
            .then(() => fetchPosts())
            .catch(err => console.error(err));
    }, []);

    if (loading) return <div className="p-4">Loading posts...</div>;

    return (
        <div className="p-4">
            <h1 className="text-2xl font-bold mb-4">Posts</h1>
            
            {posts.map(post => (
                <div key={post.id} className="border p-4 mb-6 rounded shadow">
                    <div className="flex items-center mb-2">
                        <img 
                            src={post.user.profile_photo || '/default-profile.png'} 
                            alt="Profile" 
                            className="w-10 h-10 rounded-full mr-3"
                        />
                        <div>
                            <h2 className="font-semibold">{post.user.name}</h2>
                            <p className="text-gray-500 text-sm">
                                {new Date(post.created_at).toLocaleString()}
                            </p>
                        </div>
                    </div>
                    
                    <p className="mb-3">{post.content}</p>
                    
                    {post.image && (
                        <img 
                            src={`images/${post.image}`} 
                            alt="Post" 
                            className="mt-2 mb-3 max-w-full rounded"
                        />
                    )}
                    
                    {/* Reactions */}
                    <div className="flex space-x-4 mb-3">
                        <button 
                            onClick={() => handleReaction(post.id, 'like')}
                            className={`flex items-center ${post.user_reaction === 'like' ? 'text-blue-500' : 'text-gray-500'}`}
                        >
                            <span className="mr-1">👍</span>
                            <span>{post.likes_count || 0}</span>
                        </button>
                        
                        <button 
                            onClick={() => handleReaction(post.id, 'dislike')}
                            className={`flex items-center ${post.user_reaction === 'dislike' ? 'text-red-500' : 'text-gray-500'}`}
                        >
                            <span className="mr-1">👎</span>
                            <span>{post.dislikes_count || 0}</span>
                        </button>
                        
                        <button className="flex items-center text-gray-500">
                            <span className="mr-1">💬</span>
                            <span>{post.comments?.length || 0}</span>
                        </button>
                    </div>
                    
                    {/* Comments section */}
                    <div className="mt-3">
                        {/* Existing comments */}
                        {post.comments?.map(comment => (
                            <div key={comment.id} className="flex mb-2 p-2 bg-gray-50 rounded">
                                <img 
                                    src={comment.user.profile_photo || '/default-profile.png'} 
                                    alt="Profile" 
                                    className="w-8 h-8 rounded-full mr-2"
                                />
                                <div>
                                    <p className="font-medium text-sm">{comment.user.name}</p>
                                    <p className="text-sm">{comment.content}</p>
                                </div>
                            </div>
                        ))}
                        
                        {/* Add comment */}
                        <div className="flex mt-3">
                            <input
                                type="text"
                                value={newComments[post.id] || ''}
                                onChange={(e) => setNewComments(prev => ({
                                    ...prev,
                                    [post.id]: e.target.value
                                }))}
                                placeholder="Write a comment..."
                                className="flex-1 border rounded-l px-3 py-2"
                            />
                            <button
                                onClick={() => handleCommentSubmit(post.id)}
                                className="bg-blue-500 text-white px-4 py-2 rounded-r"
                            >
                                Post
                            </button>
                        </div>
                    </div>
                </div>
            ))}
        </div>
    );
};

export default PostsIndex;